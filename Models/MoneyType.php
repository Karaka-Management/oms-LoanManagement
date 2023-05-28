<?php declare(strict_types=1);

use phpOMS\Localization\BaseStringL11n;

class MoneyType
{
    public int $id = 0;

    public string $name = '';

    public BaseStringL11n $content;

    public bool $cost = true;

    public bool $recurring = false;
}
