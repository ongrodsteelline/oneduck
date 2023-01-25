<?php

namespace App\Modules\Woocommerce;

use App\Modules\Woocommerce\Models\Product;
use WC_Order_Item_Product;

class Emails
{
    public function __construct()
    {
        add_action('woocommerce_order_item_meta_end', [$this, 'orderItem'], 10, 4);
    }

    public function orderItem($itemId, WC_Order_Item_Product $item, $order, $plainText)
    {
        $product = new Product(get_post($item->get_product_id()));

        echo view('emails.order-item-detail', [
            'productCode' => $product->getProductCode(),
            'shk1' => $product->getShk1(),
            'brand' => $product->brand->name,
            'unit' => $product->unit,
            'multiplicity' => implode(' / ', $product->multiplicity),
            'rrp' => $product->rrp
        ]);
    }
}