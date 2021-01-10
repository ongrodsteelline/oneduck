<?php

namespace App\Modules\Wordpress\Http;

use App\Core\Ajax;
use Illuminate\Support\Facades\Validator;

class AjaxController
{
    public function __construct()
    {
        Ajax::listen('save_profile', [$this, 'saveProfile'], 'yes');
    }

    public function saveProfile()
    {
        $request = request();

        $rules = [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
        ];

        if ($request->get('form')['isLegal'] === 'true') {
            $rules['legalEntity'] = 'required';
        }

        if ($request->get('form')['changePassword'] === 'true') {
            $rules['newPassword'] = 'required';
            $rules['repeatPassword'] = 'required';
        }

        if ($request->get('form')['newPassword'] !== $request->get('form')['repeatPassword']) {
            wp_send_json_error([
                'errors' => [
                    'newPassword' => 'Пароли не совпадают'
                ]
            ], 400);
        }

        $validator = Validator::make($request->get('form'), $rules, [
            'required' => 'Это поле не может быть пустым',
            'email' => 'Это поле должно быть корректным электронным адресом'
        ]);

        if ($validator->fails()) {
            $errors = [];

            foreach ($validator->messages()->messages() as $field => $messages) {
                $errors[$field] = current($messages);
            }
            wp_send_json_error([
                'errors' => $errors
            ], 400);
        }

        $user = wp_get_current_user();

        $fiels = [
            'isLegal' => 'profile_is_legal',
            'legalEntity' => 'profile_legal_entity',
            'firstname' => 'first_name',
            'lastname' => 'last_name',
            'address' => 'profile_address',
            'phone' => 'profile_phone',
            'taxId' => 'profile_tax_id',
            'iban' => 'profile_iban'
        ];

        foreach ($fiels as $key => $field) {
            if ($key == 'isLegal') {
                $value = filter_var($request->get('form')[$key], FILTER_VALIDATE_BOOLEAN);
            } else {
                $value = $request->get('form')[$key];
            }
            update_user_meta($user->ID, $field, $value);
        }

        if ($request->get('form')['changePassword']) {
            wp_set_password($request->get('form')['repeatPassword'], $user->ID);
            wp_set_auth_cookie($user->ID);
            wp_set_current_user($user->ID);
            do_action('wp_login', $user->user_login, $user);
        }

        wp_update_user([
            'ID' => $user->ID,
            'user_email' => $request->get('form')['email']
        ]);

        wp_send_json_success();
    }
}