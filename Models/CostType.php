<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\LoanManagement\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.2
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\LoanManagement\Models;

use phpOMS\Localization\BaseStringL11n;
use phpOMS\Localization\ISO639x1Enum;

/**
 * CostType class.
 *
 * @package Modules\LoanManagement\Models
 * @license OMS License 2.2
 * @link    https://jingga.app
 * @since   1.0.0
 */
class CostType implements \JsonSerializable
{
    /**
     * Article ID.
     *
     * @var int
     * @since 1.0.0
     */
    public int $id = 0;

    public string $name = '';

    /**
     * Title.
     *
     * @var string|BaseStringL11n
     * @since 1.0.0
     */
    public string | BaseStringL11n $l11n = '';

    public int $sign = -1;

    public bool $isLoan = false;

    /**
     * @return string
     *
     * @since 1.0.0
     */
    public function getL11n() : string
    {
        return $this->l11n instanceof BaseStringL11n ? $this->l11n->content : $this->l11n;
    }

    /**
     * Set l11n
     *
     * @param string|BaseStringL11n $l11n Tag article l11n
     * @param string                $lang Language
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setL11n(string | BaseStringL11n $l11n, string $lang = ISO639x1Enum::_EN) : void
    {
        if ($l11n instanceof BaseStringL11n) {
            $this->l11n = $l11n;
        } elseif (isset($this->l11n) && $this->l11n instanceof BaseStringL11n) {
            $this->l11n->content = $l11n;
        } else {
            $this->l11n           = new BaseStringL11n();
            $this->l11n->content  = $l11n;
            $this->l11n->language = $lang;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id'   => $this->id,
            'l11n' => $this->l11n,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize() : mixed
    {
        return $this->toArray();
    }
}
