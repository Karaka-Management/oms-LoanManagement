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

/**
 * Investment object.
 *
 * @package Modules\InvestmentManagement\Models
 * @license OMS License 2.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class InvestmentObject
{
    public int $id = 0;

    public string $productName = '';

    public string $description = '';

    public int $supplier = 0;

    public string $supplierName = '';

    public string $productLink = '';

    /**
     * Costs / Revenue
     */
    public array $money = [];

    public bool $approved = false;

    public array $attributes = [];
}
