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

use phpOMS\Business\Finance\DepreciationType;
use phpOMS\Stdlib\Base\FloatInt;

/**
 * Costs/Earnings.
 *
 * @package Modules\InvestmentManagement\Models
 * @license OMS License 2.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class Money
{
    public int $id = 0;

    public string $name = '';

    public int $depreciationType = DepreciationType::STAIGHT_LINE;

    public int $depreciationDuration = 0;

    public FloatInt $amount;

    public FloatInt $residualValue;

    public MoneyType $moneyType;

    public bool $recurring = false;
}
