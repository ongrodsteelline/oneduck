<?php

namespace App\Modules\Woocommerce\OrderHistory;

use App\Core\Ajax;
use App\Modules\Woocommerce\Cart\Cart;

class AjaxController
{
    public function __construct()
    {
        Ajax::listen('load_orders', [$this, 'loadOrders'], 'yes');
        Ajax::listen('copy_order', [$this, 'copyOrder'], 'yes');
    }

    public function loadOrders()
    {
        $request = request();

        $user = wp_get_current_user();

        $paged = ($request->get('paged')) ? $request->get('paged') : 1;

        $orders = OrderHistory::get($user->ID, $paged);

        wp_send_json_success([
            'orders' => $orders,
            'isLastPage' => (count($orders) < 10) ? true : false
        ]);
    }

    public function copyOrder()
    {
        $request = request();

        $cart = new Cart();

        $result = OrderHistory::addOrderItemsToCart($request->get('order_id'));

        wp_send_json_success([
            'result' => $result,
            'cart' => $cart->items()
        ]);
    }
}