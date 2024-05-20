<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\LoanManagement
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.2
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\LoanManagement\Controller;

use Modules\LoanManagement\Models\LoanMapper;
use phpOMS\Contract\RenderableInterface;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Views\View;

/**
 * Loaning controller class.
 *
 * @package Modules\LoanManagement
 * @license OMS License 2.2
 * @link    https://jingga.app
 * @since   1.0.0
 */
final class BackendController extends Controller
{
    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewLoanList(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/LoanManagement/Theme/Backend/loan-list');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1008301001, $request, $response);

        $view->data['loans'] = LoanMapper::getAll()
            ->executeGetArray();

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewLoanCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/LoanManagement/Theme/Backend/loan-view');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1008301001, $request, $response);

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewLoanView(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/LoanManagement/Theme/Backend/loan-view');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1008301001, $request, $response);

        $view->data['loan'] = LoanMapper::get()
            ->with('loanProvider')
            ->with('loanProvider/account')
            ->where('id', (int) $request->getData('id'))
            ->execute();

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewLoanTable(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/LoanManagement/Theme/Backend/loan-table');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1008301001, $request, $response);

        return $view;
    }
}
