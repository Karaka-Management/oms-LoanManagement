<?php declare(strict_types=1);

use Modules\LoanManagement\Controller\BackendController;
use Modules\LoanManagement\Models\PermissionCategory;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/finance/loan/list.*$' => [
        [
            'dest'       => '\Modules\LoanManagement\Controller\BackendController:viewLoanList',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::LOAN,
            ],
        ],
    ],
    '^.*/finance/loan/single.*$' => [
        [
            'dest'       => '\Modules\LoanManagement\Controller\BackendController:viewLoanSingle',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::LOAN,
            ],
        ],
    ],
    '^.*/finance/loan/create.*$' => [
        [
            'dest'       => '\Modules\LoanManagement\Controller\BackendController:viewLoanCreate',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::LOAN,
            ],
        ],
    ],
];
