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

use Modules\Admin\Models\Account;
use phpOMS\Business\Finance\DepreciationType;

/**
 * Investment model.
 *
 * @package Modules\InvestmentManagement\Models
 * @license OMS License 2.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class Investment
{
    public int $id = 0;

    public string $name = '';

    public int $depreciationType = DepreciationType::STAIGHT_LINE;

    public array $objects = [];

    /**
     * Income
     */
    public array $ammortization = [];

    public Account $createdBy;

    public array $attributeTypes = [];
}
