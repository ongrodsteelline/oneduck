<?php

namespace App\Modules\Woocommerce\Checkout;

use App\Modules\Woocommerce\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Checkout
{
    public function __construct()
    {
    }

    public function createOrder(Order $order)
    {
        $cart = new Cart();

        if (count($cart->items()) === 0) {
            wp_send_json_error([
                'message' => 'Ваша корзина пока пуста'
            ]);
        }

        if (!$cart->isValid()) {
            wp_send_json_error([
                'message' => 'В корзине присутствуют товары с некорректной кратностью. Проверьте список и попробуйте еще раз.'
            ]);
        }

        $rules = [
            'payment' => 'required'
        ];
        if ($order->isDelivery()) {
            $rules['address'] = 'min:10';
        }
        $validator = Validator::make([
            'address' => $order->getAddress(),
            'payment' => $order->getPayment()
        ], $rules);

        if ($validator->fails()) {
            return [
                'success' => false,
                'message' => implode('<br>', $validator->messages()->all())
            ];
        }

        $user = wp_get_current_user();
        $userAddress = (strlen($order->getAddress()) < 10) ? get_user_meta($user->ID, 'adress', true) : $order->getAddress();
        $address = [
            'first_name' => get_user_meta($user->ID, 'first_name', true),
            'last_name' => get_user_meta($user->ID, 'last_name', true),
            'company' => get_user_meta($user->ID, 'nameur', true),
            'address_1' => $userAddress,
        ];

        $wcOrder = wc_create_order();

        update_post_meta($wcOrder->get_id(), 'is_delivery', $order->isDelivery());
        update_post_meta($wcOrder->get_id(), 'payment_method', $order->getPayment());

        $wcOrder->set_customer_id($user->ID);
        if ($order->getComment()) {
            $wcOrder->add_order_note($order->getComment(), $user->ID, true);
        }

        foreach ($cart->items() as $item) {
            $wcOrder->add_product(wc_get_product($item['product_id']), $item['quantity']);
        }
        $wcOrder->set_address($address, 'billing');
        $wcOrder->update_status('processing');
        $wcOrder->calculate_totals();

        WC()->cart->empty_cart();

        return [
            'success' => true,
            'url' => wc_get_checkout_url() . '?order-received=' . $wcOrder->get_id() . '&key=' . $wcOrder->get_order_key()
        ];
    }
}