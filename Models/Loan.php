<?php
/**
 * Jingga
 *
 * PHP Version 8.1
 *
 * @package   Modules\LoanManagement\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\LoanManagement\Models;

/**
 * Loan model.
 *
 * @package Modules\LoanManagement\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
class Loan
{
    public int $id = 0;

    public string $name = '';

    public string $description = '';

    public int $status = LoanStatus::DRAFT;

    public int $amount = 0;

    public int $acquisitionFee = 0;

    public int $disagio = 0;

    public int $nominalBorrowingRate = 0;

    public int $startingRepaymentRate = 0;

    public int $startingRepayment = 0;

    // 0 = end of month
    public int $dayOfRepayment = 0;

    // monthly, quarterly, annually, end of duration
    public int $interestInterval = 0;

    public int $interestTaxRate = 0;

    // monthly, quarterly, annually, end of duration
    public int $repaymentInterval = 0;

    // months
    public int $duration = 0;

    public int $repaymentFreeTime = 0;

    // Either separate (during the repayment free time) or during the repayment time
    public int $repaymentFreeInterest = 1;

    public int $residualAmountAfterDuration = 0;

    public int $annualSpecialPayment = 0;

    public bool $isSpecialPaymentAllowed = false;

    public \DateTime $start;

    public \DateTime $end;

    public \DateTime $payout;

    // 0 = not possible
    public int $interestRateAfterDuration = 0;

    // used to indicate if the interests/payments/taxes are manually adjusted
    public bool $hasManualInterestAmounts = false;

    public array $interests = [];

    // in and out
    public array $payments = [];

    public bool $hasManualPaymentAmounts = false;

    public array $taxes = [];

    public bool $hasManualTaxAmounts = false;
}
