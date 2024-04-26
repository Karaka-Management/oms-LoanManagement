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

use phpOMS\Stdlib\Base\FloatInt;

/**
 * Loan model.
 *
 * @package Modules\LoanManagement\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
class LoanElement
{
    public int $id = 0;

    public string $description = '';

    public FloatInt $amount;

    public \DateTime $date;

    public int $loan = 0;

    public CostType $type;

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->amount = new FloatInt();
        $this->date   = new \DateTime();
        $this->type   = new NullCostType();
    }
}
