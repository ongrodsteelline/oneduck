<?php

namespace App\Modules\Woocommerce\Exchange;

abstract class CurrencyAbstract
{
    protected $key;

    /**
     * @return float
     */
    public function getValue(): float
    {
        $value = get_field('currency_'.$this->key, 'options');
        return ($value === 0 || $value === null) ? 1 : $value;
    }
}