<?php

use phpOMS\Business\Finance\DepreciationType;
use phpOMS\Stdlib\Base\FloatInt;

class Money {
    public int $id = 0;

    public string $name = '';

    public int $depreciationType = DepreciationType::STAIGHT_LINE;

    public int $depreciationDuration = 0;

    public FloatInt $amount;

    public FloatInt $residualValue;

    public MoneyType $moneyType;

    public bool $recurring = false;
}