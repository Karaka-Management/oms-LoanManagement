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

use phpOMS\DataStorage\Database\Mapper\DataMapperFactory;

/**
 * LoanElement mapper class.
 *
 * @package Modules\LoanManagement\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 *
 * @template T of LoanElement
 * @extends DataMapperFactory<T>
 */
final class LoanElementMapper extends DataMapperFactory
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    public const COLUMNS = [
        'loanmgmt_loan_element_id'          => ['name' => 'loanmgmt_loan_element_id',       'type' => 'int',    'internal' => 'id'],
        'loanmgmt_loan_element_description' => ['name' => 'loanmgmt_loan_element_description',     'type' => 'string', 'internal' => 'description'],
        'loanmgmt_loan_element_date'        => ['name' => 'loanmgmt_loan_element_date',     'type' => 'DateTime', 'internal' => 'date'],
        'loanmgmt_loan_element_type'        => ['name' => 'loanmgmt_loan_element_type',     'type' => 'int', 'internal' => 'type'],
        'loanmgmt_loan_element_loan'        => ['name' => 'loanmgmt_loan_element_loan',     'type' => 'int', 'internal' => 'loan'],
        'loanmgmt_loan_element_amount'      => ['name' => 'loanmgmt_loan_element_amount',     'type' => 'Serializable', 'internal' => 'amount'],
    ];

    /**
     * Has one relation.
     *
     * @var array<string, array{mapper:class-string, external:string, by?:string, column?:string, conditional?:bool}>
     * @since 1.0.0
     */
    public const OWNS_ONE = [
        'type' => [
            'mapper'   => CostTypeMapper::class,
            'external' => 'loanmgmt_loan_element_type',
        ],
    ];

    /**
     * Model to use by the mapper.
     *
     * @var class-string<T>
     * @since 1.0.0
     */
    public const MODEL = LoanElement::class;

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    public const TABLE = 'loanmgmt_loan_element';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    public const PRIMARYFIELD = 'loanmgmt_loan_element_id';
}
