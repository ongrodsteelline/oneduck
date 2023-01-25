<?php

namespace App\Modules\Woocommerce\Helpers;

class Helper
{
    public static function getWarehouses()
    {
        $warehouses = get_terms([
            'hide_empty' => false,
            'taxonomy' => 'product_warehouse',
        ]);

        /*
         * По умолчанию для новых пользователей все склады выбраны
         * */
        if (self::getSelectedWarehouses() === null) {
            self::storeSelectedWarehouses(array_map(function ($warehouse) {
                return $warehouse->term_id;
            }, $warehouses));
        }

        foreach ($warehouses as $warehouse) {
            if (in_array($warehouse->term_id, self::getSelectedWarehouses())) {
                $warehouse->active = true;
            }
        }

        return $warehouses;
    }

    public static function getSelectedWarehouses()
    {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();

            $selected = get_user_meta($user->ID, 'selected_warehouses', true);
        } else {
            $selected = WC()->session->get('cf_selected_warehouses');
        }

        return $selected;
    }

    public static function storeSelectedWarehouses($data)
    {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();

            update_user_meta($user->ID, 'selected_warehouses', $data);
        } else {
            WC()->session->set_customer_session_cookie(true);
            WC()->session->set('cf_selected_warehouses', $data);
        }
    }
}
