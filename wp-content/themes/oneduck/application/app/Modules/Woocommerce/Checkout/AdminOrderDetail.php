<?php

namespace App\Modules\Woocommerce\Checkout;

class AdminOrderDetail
{
    public function __construct()
    {
        add_action('woocommerce_admin_order_data_after_billing_address', [$this, 'orderDetail']);
    }

    public function orderDetail(\WC_Order $order)
    {
        $isDelivery = get_post_meta($order->get_id(), 'is_delivery', true);
        $isDeliveryFormatted = ($isDelivery) ? 'Да' : 'Нет';

        $paymentMethods = [
            'first' => 'Первая форма',
            'second' => 'Вторая форма',
            'mixed' => 'Смешанная форма'
        ];
        $payment = get_post_meta($order->get_id(), 'payment_method', true);

        echo view('admin.order-detail', [
            'isDelivery' => $isDeliveryFormatted,
            'payment' => $paymentMethods[$payment]
        ]);
    }
}