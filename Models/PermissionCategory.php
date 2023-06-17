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
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\LoanManagement\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Permision state enum.
 *
 * @package Modules\LoanManagement\Models
 * @license OMS License 2.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
abstract class PermissionCategory extends Enum
{
    public const LOAN = 1;
}
