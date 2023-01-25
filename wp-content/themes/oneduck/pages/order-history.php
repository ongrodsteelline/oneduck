<?php
/* Template Name: Order History */

use App\Modules\Woocommerce\OrderHistory\OrderHistory;

if (!is_user_logged_in()) {
    wp_redirect(home_url());
}

$user = wp_get_current_user();
$orders = OrderHistory::get($user->ID);

echo view('order-history.index', [
    'orders' => $orders
]);