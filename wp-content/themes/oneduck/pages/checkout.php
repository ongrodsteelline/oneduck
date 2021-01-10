<?php
/* Template Name: Checkout */

use App\Modules\Wordpress\Helper;

Helper::disableCacheResponse();

$request = request();
$user = wp_get_current_user();
$address = get_user_meta($user->ID, 'profile_address', true);
$isAuth = is_user_logged_in();
$isOrderReceived = false;

if ($request->get('order-received')) {
    $order = wc_get_order($request->get('order-received'));
    if ($request->get('key') === $order->get_order_key()) {
        $isOrderReceived = true;
    }
}

echo view('checkout.index', [
    'isAuth' => $isAuth,
    'address' => $address,
    'isOrderReceived' => $isOrderReceived,
    'order' => $order
]);