<?php
/**
 * Karaka
 *
 * PHP Version 8.1
 *
 * @package   Modules\InvestmentManagement\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\InvestmentManagement\Models;

use phpOMS\Localization\BaseStringL11n;

/**
 * Money type (one off cost, recurring, earnings).
 *
 * @package Modules\InvestmentManagement\Models
 * @license OMS License 2.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class MoneyType
{
    public int $id = 0;

    public string $name = '';

    public BaseStringL11n $content;

    public bool $cost = true;

    public bool $recurring = false;
}
