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
use phpOMS\Localization\BaseStringL11n;

/**
 * CostTypeL11n mapper class.
 *
 * @package Modules\LoanManagement\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 *
 * @template T of BaseStringL11n
 * @extends DataMapperFactory<T>
 */
final class CostTypeL11nMapper extends DataMapperFactory
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    public const COLUMNS = [
        'loanmgmt_cost_type_l11n_id'       => ['name' => 'loanmgmt_cost_type_l11n_id',    'type' => 'int',    'internal' => 'id'],
        'loanmgmt_cost_type_l11n_title'    => ['name' => 'loanmgmt_cost_type_l11n_title', 'type' => 'string', 'internal' => 'content', 'autocomplete' => true],
        'loanmgmt_cost_type_l11n_type'     => ['name' => 'loanmgmt_cost_type_l11n_type',  'type' => 'int',    'internal' => 'ref'],
        'loanmgmt_cost_type_l11n_language' => ['name' => 'loanmgmt_cost_type_l11n_language',  'type' => 'string', 'internal' => 'language'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    public const TABLE = 'loanmgmt_cost_type_l11n';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    public const PRIMARYFIELD = 'loanmgmt_cost_type_l11n_id';

    /**
     * Model to use by the mapper.
     *
     * @var class-string<T>
     * @since 1.0.0
     */
    public const MODEL = BaseStringL11n::class;
}
