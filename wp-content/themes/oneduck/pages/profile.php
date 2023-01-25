<?php
/* Template Name: Profile */

use App\Modules\Wordpress\Models\User;

if (!is_user_logged_in()) {
    wp_redirect(home_url());
}

$user = new User();

echo view('profile.index', [
    'user' => [
        'firstname' => $user->getUser()->first_name,
        'lastname' => $user->getUser()->last_name,
        'email' => $user->getUser()->user_email,
        'phone' => get_field('profile_phone', 'user_' . $user->getUser()->ID),
        'address' => get_field('profile_address', 'user_' . $user->getUser()->ID),
        'taxId' => get_field('profile_tax_id', 'user_' . $user->getUser()->ID),
        'iban' => get_field('profile_iban', 'user_' . $user->getUser()->ID),
        'isLegal' => get_field('profile_is_legal', 'user_' . $user->getUser()->ID),
        'legalEntity' => get_field('profile_legal_entity', 'user_' . $user->getUser()->ID),
        'group' => $user->getGroup(),
        'groupMixed' => $user->getGroupMixed()
    ]
]);
