<?php

use App\Modules\Woocommerce\Cart\Cart;
use App\Modules\Woocommerce\Helpers\CategoryList;
use App\Modules\Woocommerce\Helpers\Helper;
use App\Modules\Wordpress\Models\User;

global $user_ID;

$userdata = get_user_by('id', $user_ID);
$current_user = wp_get_current_user();
$cart = new Cart();
$cartItems = $cart->items();
$user = new User();

echo view('parts.header', [
    'user' => $user,
    'userdata' => $userdata,
    'current_user' => $current_user,
    'categories' => CategoryList::getCategories(),
    'cartItems' => $cartItems,
    'warehouses' => Helper::getWarehouses()
]);
