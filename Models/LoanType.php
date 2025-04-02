<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\LoanManagement\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.2
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\LoanManagement\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Loan type enum.
 *
 * @package Modules\LoanManagement\Models
 * @license OMS License 2.2
 * @link    https://jingga.app
 * @since   1.0.0
 */
abstract class LoanType extends Enum
{
    public const AMORTIZED_LOAN = 1;

    public const DEFERRED_PAYMENT_LOAN = 2;

    public const BOND_LOAN = 3;
}
