<?php

namespace App\Modules\Woocommerce\Cart;

use App\Modules\Woocommerce\Models\Product;

class Cart
{
    public function addItem(int $productId, $quantity)
    {
        $productCartId = WC()->cart->generate_cart_id($productId);
        $this->items();

        if (WC()->cart->find_product_in_cart($productCartId)) {
            if ($quantity <= 0) {
                $this->removeItem($productCartId);
            } else {
                WC()->cart->set_quantity($productCartId, $quantity);
            }
        } else {
            $product = wc_get_product($productId);
            if ($quantity > $product->get_stock_quantity()) {
                $productCartId = WC()->cart->add_to_cart($productId, 1);
                if ($productCartId) {
                    WC()->cart->set_quantity($productCartId, $quantity);
                }
            } else {
                WC()->cart->add_to_cart($productId, $quantity);
            }
        }
    }

    public function removeItem($itemKey)
    {
        WC()->cart->remove_cart_item($itemKey);
    }

    public function clear()
    {
        WC()->cart->empty_cart();
    }

    public function items()
    {
        $items = [];

        foreach (WC()->cart->get_cart() as $item) {
            $product = new Product(get_post($item['product_id']));
            $isValid = ($this->validateMultiplicity((int)$item['quantity'], $product->getFirstMultiplicity()) && $this->validateQuantityAvailable((int)$item['quantity'], $product->stockQuantity)) ? true : false;
            $items[] = [
                'key' => $item['key'],
                'product' => $product,
                'product_id' => $item['product_id'],
                'quantity' => (int)$item['quantity'],
                'isValid' => $isValid,
                'comment' => $item['comment']
            ];
        }

        return $items;
    }

    public function isValid()
    {
        foreach ($this->items() as $item) {
            if ($item['isValid']) {
                return true;
            }
        }

        return false;
    }

    public function validateMultiplicity($quantity, $step)
    {
        $result = $quantity % $step;
        if ($result === 0) {
            return true;
        }

        return false;
    }

    public function validateQuantityAvailable($quantity, $available)
    {
        if ($quantity <= $available) {
            return true;
        }

        return false;
    }
}