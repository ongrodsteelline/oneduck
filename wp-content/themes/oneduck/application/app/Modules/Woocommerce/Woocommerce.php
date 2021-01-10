<?php

namespace App\Modules\Woocommerce;

use App\Core\Module;

class Woocommerce extends Module
{
    function providers()
    {
        return [
            Register\BrandTaxonomy::class,
            ShopController::class,
            Http\AjaxController::class,
            Cart\AjaxController::class,
            Checkout\AjaxController::class,
            Checkout\AdminOrderDetail::class
        ];
    }
}