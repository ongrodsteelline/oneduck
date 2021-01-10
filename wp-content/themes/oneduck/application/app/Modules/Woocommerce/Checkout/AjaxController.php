<?php

namespace App\Modules\Woocommerce\Checkout;

use App\Core\Ajax;

class AjaxController
{
    public $request;
    public $cart;

    public function __construct()
    {
        $this->request = request();

        Ajax::listen('create_order', [$this, 'createOrder']);
    }

    public function createOrder()
    {
        $order = new Order();
        if ($this->request->get('form')['isDelivery'] === 'true') {
            $order->enableDelivery();
        }
        $order->setAddress($this->request->get('form')['address']);
        $order->setPayment($this->request->get('form')['payment']);
        $order->setComment($this->request->get('form')['comment']);

        $checkout = new Checkout();
        $result = $checkout->createOrder($order);

        wp_send_json($result);
    }
}