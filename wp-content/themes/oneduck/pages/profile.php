<?php
/* Template Name: Profile */

if (!is_user_logged_in()) {
    wp_redirect(home_url());
}

$user = wp_get_current_user();

echo view('profile.index', [
    'user' => [
        'firstname' => $user->first_name,
        'lastname' => $user->last_name,
        'email' => $user->user_email,
        'phone' => get_field('profile_phone', 'user_' . $user->ID),
        'address' => get_field('profile_address', 'user_' . $user->ID),
        'taxId' => get_field('profile_tax_id', 'user_' . $user->ID),
        'iban' => get_field('profile_iban', 'user_' . $user->ID),
        'isLegal' => get_field('profile_is_legal', 'user_' . $user->ID),
        'legalEntity' => get_field('profile_legal_entity', 'user_' . $user->ID)
    ]
]);