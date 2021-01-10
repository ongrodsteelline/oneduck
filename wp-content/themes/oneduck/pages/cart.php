<?php
/* Template Name: Cart */

use App\Modules\Wordpress\Helper;

Helper::disableCacheResponse();

$isAuth = is_user_logged_in();

echo view('cart.index', [
    'isAuth' => $isAuth
]);