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

use Modules\SupplierManagement\Models\NullSupplier;
use Modules\SupplierManagement\Models\Supplier;
use phpOMS\Stdlib\Base\FloatInt;

/**
 * Loan model.
 *
 * @package Modules\LoanManagement\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
class Loan
{
    public int $id = 0;

    public string $name = '';

    public string $description = '';

    public Supplier $loanProvider;

    public int $status = LoanStatus::DRAFT;

    public FloatInt $nominalBorrowingRate;

    // 0 = not possible
    public FloatInt $interestRateAfterDuration;

    public bool $isSpecialPaymentAllowed = false;

    public \DateTime $start;

    public \DateTime $end;

    public \DateTimeImmutable $createdAt;

    public int $createdBy = 0;

    public int $unit = 0;

    public array $elements = [];

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();

        $this->loanProvider = new NullSupplier();
        $this->start        = new \DateTime();
        $this->end          = $this->start->modify('+1 year');

        $this->nominalBorrowingRate      = new FloatInt();
        $this->interestRateAfterDuration = new FloatInt();
    }
}
