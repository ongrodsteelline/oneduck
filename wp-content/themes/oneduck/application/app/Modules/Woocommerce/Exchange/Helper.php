<?php

namespace App\Modules\Woocommerce\Exchange;

class Helper
{
    /**
     * @param  int  $price
     * @param  int  $currency
     * @return float|int
     */
    public static function calculate(float $price, CurrencyAbstract $currency): float
    {
        return round($price / $currency->getValue(), 2);
    }
}