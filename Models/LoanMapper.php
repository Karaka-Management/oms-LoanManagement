<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\LoanManagement\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\LoanManagement\Models;

use Modules\SupplierManagement\Models\SupplierMapper;
use phpOMS\DataStorage\Database\Mapper\DataMapperFactory;

/**
 * Loan mapper class.
 *
 * @package Modules\LoanManagement\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 *
 * @template T of Loan
 * @extends DataMapperFactory<T>
 */
final class LoanMapper extends DataMapperFactory
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    public const COLUMNS = [
        'loanmgmt_loan_id'   => ['name' => 'loanmgmt_loan_id',       'type' => 'int',    'internal' => 'id'],
        'loanmgmt_loan_name' => ['name' => 'loanmgmt_loan_name',     'type' => 'string', 'internal' => 'name', 'autocomplete' => true],
        'loanmgmt_loan_description' => ['name' => 'loanmgmt_loan_description',     'type' => 'string', 'internal' => 'description'],
        'loanmgmt_loan_start' => ['name' => 'loanmgmt_loan_start',     'type' => 'DateTime', 'internal' => 'start'],
        'loanmgmt_loan_end' => ['name' => 'loanmgmt_loan_end',     'type' => 'DateTime', 'internal' => 'end'],
        'loanmgmt_loan_created_at' => ['name' => 'loanmgmt_loan_created_at',     'type' => 'DateTimeImmutable', 'internal' => 'createdAt'],
        'loanmgmt_loan_created_by' => ['name' => 'loanmgmt_loan_created_by',     'type' => 'int', 'internal' => 'createdBy'],
        'loanmgmt_loan_unit' => ['name' => 'loanmgmt_loan_unit',     'type' => 'int', 'internal' => 'unit'],
        'loanmgmt_loan_supplier' => ['name' => 'loanmgmt_loan_supplier',     'type' => 'int', 'internal' => 'supplier'],
        'loanmgmt_loan_status' => ['name' => 'loanmgmt_loan_status',     'type' => 'int', 'internal' => 'status'],
        'loanmgmt_loan_borrowing_rate' => ['name' => 'loanmgmt_loan_borrowing_rate',     'type' => 'Serializable', 'internal' => 'nominalBorrowingRate'],
        'loanmgmt_loan_post_rate' => ['name' => 'loanmgmt_loan_post_rate',     'type' => 'Serializable', 'internal' => 'interestRateAfterDuration'],
        'loanmgmt_loan_special_payment' => ['name' => 'loanmgmt_loan_special_payment',     'type' => 'bool', 'internal' => 'isSpecialPaymentAllowed'],
    ];

    /**
     * Has one relation.
     *
     * @var array<string, array{mapper:class-string, external:string, by?:string, column?:string, conditional?:bool}>
     * @since 1.0.0
     */
    public const OWNS_ONE = [
        'supplier' => [
            'mapper'   => SupplierMapper::class,
            'external' => 'loanmgmt_loan_supplier',
        ],
    ];

    /**
     * Has many relation.
     *
     * @var array<string, array{mapper:class-string, table:string, self?:?string, external?:?string, column?:string}>
     * @since 1.0.0
     */
    public const HAS_MANY = [
        'elements' => [
            'mapper'   => LoanElementMapper::class,
            'table'    => 'loanmgmt_loan_element',
            'self'     => 'loanmgmt_loan_element_loan',
            'external' => null,
        ],
    ];

    /**
     * Model to use by the mapper.
     *
     * @var class-string<T>
     * @since 1.0.0
     */
    public const MODEL = Loan::class;

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    public const TABLE = 'loanmgmt_loan';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    public const PRIMARYFIELD = 'loanmgmt_loan_id';
}
