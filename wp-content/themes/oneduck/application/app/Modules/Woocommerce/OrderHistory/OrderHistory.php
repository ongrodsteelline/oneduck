<?php

namespace App\Modules\Woocommerce\OrderHistory;

use App\Modules\Woocommerce\Models\Product;
use Carbon\Carbon;

class OrderHistory
{
    /*
     * Получаем историю заказов пользователя
     * */
    public static function get($userId, $page = 1, $limit = 10)
    {
        $orders = wc_get_orders([
            'customer_id' => $userId,
            'paged' => $page,
            'limit' => $limit
        ]);

        $history = [];

        foreach ($orders as $order) {
            $history[$order->get_id()] = [
                'id' => $order->get_id(),
                'created' => Carbon::parse($order->get_date_created()->format('c'))->setTimezone('Europe/Minsk')->format('Y.m.d в H:i'),
                'total' => $order->get_total(),
                'items' => []
            ];

            foreach ($order->get_items() as $itemKey => $item) {
                /* @var $item \WC_Order_Item_Product */
                if ($item->get_product_id() === 0) {
                    continue;
                }
                $post = get_post($item->get_product_id());
                $product = new Product($post);
                $orderItemRrp = $item->get_meta('_product_rrp');
                if ($orderItemRrp) {
                    $product->rrp = $orderItemRrp;
                }
                $product->regularPrice = round($item->get_total() / $item->get_quantity(), 2);
                $history[$order->get_id()]['items'][] = [
                    'product' => $product,
                    'product_id' => $item->get_product_id(),
                    'quantity' => $item->get_quantity()
                ];
            }
        }

        $history = array_values($history);

        return $history;
    }

    /*
     * Добавляем товары из заказа в корзину
     * Товар может быть добавлен в корзину, если:
     * - Отсутствует в корзине
     * - Есть в наличие
     * - Не удален
     * */
    public static function addOrderItemsToCart($orderId)
    {
        $order = wc_get_order($orderId);

        $statuses = [];

        foreach ($order->get_items() as $item) {
            /* @var $item \WC_Order_Item_Product */
            if ($product = $item->get_product()) {
                $productCartId = WC()->cart->generate_cart_id($product->get_id());
                WC()->cart->get_cart();

                if (WC()->cart->find_product_in_cart($productCartId)) {
                    $statuses[$product->get_id()] = [
                        'status' => 'exists'
                    ];
                } else if ($product->get_stock_quantity() === 0) {
                    $statuses[$product->get_id()] = [
                        'status' => 'outofstock'
                    ];
                } else if ($product->get_status() === 'trash') {
                    $statuses[$product->get_id()] = [
                        'status' => 'trash'
                    ];
                } else {
                    $statuses[$product->get_id()] = [
                        'status' => 'available',
                        'quantity' => $item->get_quantity()
                    ];
                }
            }
        }

        $availableList = array_filter($statuses, function ($value) {
            return $value['status'] === 'available';
        }, ARRAY_FILTER_USE_BOTH);

        foreach ($availableList as $productId => $data) {
            $product = wc_get_product($productId);
            /*
             * Хак для добавления товара с количетсвом превышающим сток
             * */
            if ($data['quantity'] > $product->get_stock_quantity()) {
                $productCartId = WC()->cart->add_to_cart($productId, 1);
                if ($productCartId) {
                    WC()->cart->set_quantity($productCartId, $data['quantity']);
                }
            } else {
                WC()->cart->add_to_cart($productId, $data['quantity']);
            }
        }

        return $statuses;
    }
}