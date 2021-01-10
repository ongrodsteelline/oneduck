<?php

namespace App\Modules\Woocommerce\Cart;

use App\Core\Ajax;

class AjaxController
{
    public $request;
    public $cart;

    public function __construct()
    {
        $this->request = request();
        $this->cart = new Cart();

        Ajax::listen('add_to_cart', [$this, 'addToCart']);
        Ajax::listen('remove_from_cart', [$this, 'removeFromCart']);
        Ajax::listen('clear_cart', [$this, 'clearCart']);
    }

    public function addToCart()
    {
        $this->cart->addItem($this->request->get('product_id'), $this->request->get('quantity'));

        wp_send_json([
            'items' => $this->cart->items()
        ]);
    }

    public function removeFromCart()
    {
        $this->cart->removeItem($this->request->get('item_key'));

        wp_send_json([
            'items' => $this->cart->items()
        ]);
    }

    public function clearCart()
    {
        $this->cart->clear();

        wp_send_json([
            'items' => $this->cart->items()
        ]);
    }
}