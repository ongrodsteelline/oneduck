<?php

namespace App\Modules\Woocommerce;

use App\Core\Module;

class Woocommerce extends Module
{
    function providers()
    {
        return [
            Taxonomies::class,

            ShopController::class,

            Http\AjaxController::class,

            Cart\AjaxController::class,

            Checkout\AjaxController::class,
            Checkout\AdminOrderDetail::class,
            Checkout\Checkout::class,

            OrderHistory\AjaxController::class,

            Filter\Admin::class,

            Exchange\AcfReadOnly::class,

            Emails::class,

            Import\Admin::class
        ];
    }
}
