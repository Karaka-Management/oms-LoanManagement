<?php
declare(strict_types=1);

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
