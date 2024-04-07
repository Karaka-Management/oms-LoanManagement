<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\LoanManagement
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\LoanManagement\Controller;

use Modules\LoanManagement\Models\CostType;
use Modules\LoanManagement\Models\CostTypeL11nMapper;
use Modules\LoanManagement\Models\CostTypeMapper;
use Modules\LoanManagement\Models\Loan;
use Modules\LoanManagement\Models\LoanElement;
use Modules\LoanManagement\Models\LoanMapper;
use Modules\LoanManagement\Models\LoanStatus;
use Modules\LoanManagement\Models\NullCostType;
use Modules\SupplierManagement\Models\NullSupplier;
use phpOMS\Business\Finance\Loan as FinanceLoan;
use phpOMS\Localization\BaseStringL11n;
use phpOMS\Localization\ISO639x1Enum;
use phpOMS\Message\Http\RequestStatusCode;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Stdlib\Base\FloatInt;
use phpOMS\Stdlib\Base\SmartDateTime;

/**
 * LoanManagement class.
 *
 * @package Modules\LoanManagement
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
final class ApiController extends Controller
{
    /**
     * Api method to create loan
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiLoanCreate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        if (!empty($val = $this->validateLoanCreate($request))) {
            $response->header->status = RequestStatusCode::R_400;
            $this->createInvalidCreateResponse($request, $response, $val);

            return;
        }

        $costType = $this->createLoanFromRequest($request);
        $this->createModel($request->header->account, $costType, LoanMapper::class, 'loan', $request->getOrigin());
        $this->createStandardCreateResponse($request, $response, $costType);
    }

    /**
     * Validate cost type create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateLoanCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['name'] = !$request->hasData('name'))
            || ($val['supplier'] = !$request->hasData('supplier'))
            || ($val['start'] = !$request->hasData('start'))
            || ($val['duration'] = !$request->hasData('duration'))
            || ($val['amount'] = !$request->hasData('amount'))
            || ($val['interest_rate'] = !$request->hasData('interest_rate'))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Method to create cost type from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return Loan
     *
     * @since 1.0.0
     */
    private function createLoanFromRequest(RequestAbstract $request) : Loan
    {
        $loan = new Loan();

        $loan->createdBy                 = $request->header->account;
        $loan->name                      = $request->getDataString('name');
        $loan->description               = $request->getDataString('description');
        $loan->loanProvider              = new NullSupplier((int) $request->getDataInt('supplier'));
        $loan->status                    = LoanStatus::tryFromValue($request->getData('status')) ?? LoanStatus::ACTIVE;
        $loan->nominalBorrowingRate      = new FloatInt($request->getDataString('interest_rate') ?? 0);
        $loan->interestRateAfterDuration = new FloatInt($request->getDataString('post_interest_rate') ?? 0);
        $loan->start                     = $request->getDataDateTime('start') ?? new \DateTime('now');
        $loan->end                       = SmartDateTime::createFromDateTime($loan->start)->smartModify(0, (int) $request->getDataInt('duration'));
        $loan->isSpecialPaymentAllowed   = $request->getDataBool('special_payment_allowed') ?? false;
        $loan->unit                      = $request->getDataInt('unit') ?? $this->app->unitId;

        $paymentInterval = $request->getDataInt('payment_interval') ?? 12;

        /** @var CostType[] $types */
        $types = CostTypeMapper::getAll()->executeGetArray();

        $loanType      = new NullCostType();
        $repaymentType = new NullCostType();
        $interestType  = new NullCostType();

        foreach ($types as $type) {
            if ($type->name === 'loan') {
                $loanType = $type;
            } elseif ($type->name === 'repayment') {
                $repaymentType = $type;
            } elseif ($type->name === 'interest') {
                $interestType = $type;
            }
        }

        // Loan
        $element         = new LoanElement();
        $element->amount = new FloatInt($request->getDataString('amount') ?? 0);
        $element->date   = $loan->start;
        $element->type   = $loanType;

        $loan->elements[] = $element;

        $currentDate = SmartDateTime::createFromDateTime($loan->start);
        $currentDate->smartModify(0, (int) (12 / $paymentInterval), -1);

        // @feature Handle different loan types
        $schedule = FinanceLoan::getAmortizationSchedule(
            $element->amount->getNormalizedValue(),
            $loan->nominalBorrowingRate->getNormalizedValue() / 100,
            (int) $request->getDataInt('duration'),
            $paymentInterval
        );

        foreach ($schedule as $idx => $e) {
            if ($idx === 0) {
                continue;
            }

            // Repayment
            $element         = new LoanElement();
            $element->amount = new FloatInt($e['principal']);
            $element->date   = clone $currentDate;
            $element->type   = $repaymentType;

            $loan->elements[] = $element;

            // Interest
            $element         = new LoanElement();
            $element->amount = new FloatInt($e['interest']);
            $element->date   = clone $currentDate;
            $element->type   = $interestType;

            $loan->elements[] = $element;

            $currentDate->smartModify(0, (int) (12 / $paymentInterval));
        }

        return $loan;
    }

    /**
     * Api method to calculate loan timeline based on definitions
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiLoanTimelineCalculate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
    }

    /**
     * Api method to create loan elements
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiLoanElementCreate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
    }

    /**
     * Api method to create loan cost type
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiLoanCostTypeCreate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        if (!empty($val = $this->validateCostTypeCreate($request))) {
            $response->header->status = RequestStatusCode::R_400;
            $this->createInvalidCreateResponse($request, $response, $val);

            return;
        }

        $costType = $this->createCostTypeFromRequest($request);
        $this->createModel($request->header->account, $costType, CostTypeMapper::class, 'cost_type', $request->getOrigin());
        $this->createStandardCreateResponse($request, $response, $costType);
    }

    /**
     * Validate cost type create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateCostTypeCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['title'] = !$request->hasData('title'))
            || ($val['name'] = !$request->hasData('name'))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Method to create cost type from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return CostType
     *
     * @since 1.0.0
     */
    private function createCostTypeFromRequest(RequestAbstract $request) : CostType
    {
        $costType         = new CostType();
        $costType->name   = $request->getDataString('name');
        $costType->sign   = $request->getDataInt('sign') ?? -1;
        $costType->isLoan = $request->getDataBool('is_loan') ?? false;
        $costType->setL11n(
            $request->getDataString('title') ?? '',
            ISO639x1Enum::tryFromValue($request->getDataString('language')) ?? ISO639x1Enum::_EN
        );

        return $costType;
    }

    /**
     * Api method to create loan cost l11n
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiLoanCostTypeL11nCreate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        if (!empty($val = $this->validateCostTypeL11nCreate($request))) {
            $response->header->status = RequestStatusCode::R_400;
            $this->createInvalidCreateResponse($request, $response, $val);

            return;
        }

        $costL11n = $this->createCostTypeL11nFromRequest($request);
        $this->createModel($request->header->account, $costL11n, CostTypeL11nMapper::class, 'cost_type_l11n', $request->getOrigin());
        $this->createStandardCreateResponse($request, $response, $costL11n);
    }

    /**
     * Validate cost l11n create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateCostTypeL11nCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['title'] = !$request->hasData('title'))
            || ($val['type'] = !$request->hasData('type'))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Method to create cost l11n from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return BaseStringL11n
     *
     * @since 1.0.0
     */
    private function createCostTypeL11nFromRequest(RequestAbstract $request) : BaseStringL11n
    {
        $costL11n           = new BaseStringL11n();
        $costL11n->ref      = $request->getDataInt('type') ?? 0;
        $costL11n->language = ISO639x1Enum::tryFromValue($request->getDataString('language')) ?? $request->header->l11n->language;
        $costL11n->content  = $request->getDataString('title') ?? '';

        return $costL11n;
    }
}
