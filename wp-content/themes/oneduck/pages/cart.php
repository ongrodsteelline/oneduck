<?php
/* Template Name: Cart */

use App\Modules\Wordpress\Helper;
use App\Modules\Wordpress\Models\User;

Helper::disableCacheResponse();

$user = new User();
$isAuth = is_user_logged_in();

$groups = [
    'cash' => 'Н',
    'cashless' => 'Б'
];

$currentGroup = $groups[$user->getGroupMixed()];
$alternativeGroup = ($user->getGroupMixed() === 'cash') ? 'Б' : 'Н';

echo view('cart.index', [
    'isAuth' => $isAuth,
    'group' => $user->getGroup(),
    'currentGroup' => $currentGroup,
    'alternativeGroup' => $alternativeGroup
]);