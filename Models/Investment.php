<?php 
declare(strict_types=1);

use Modules\Admin\Models\Account;
use phpOMS\Business\Finance\DepreciationType;

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
