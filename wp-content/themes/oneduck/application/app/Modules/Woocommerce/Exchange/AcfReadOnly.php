<?php

namespace App\Modules\Woocommerce\Exchange;

/**
 * Блокируем поле с курсом BYN
 * @package App\Modules\Woocommerce\Exchange
 */
class AcfReadOnly
{
    public function __construct()
    {
        add_filter('acf/load_field/name=currency_byn', function ($field) {
            $field['readonly'] = 1;
            return $field;
        });
    }
}