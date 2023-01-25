<?php

namespace App\Modules\Woocommerce\Checkout;

use App\Modules\Woocommerce\Cart\Cart;
use App\Modules\Woocommerce\Export\Fields;
use App\Modules\Woocommerce\Models\Product;
use App\Modules\Wordpress\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Checkout
{
    public function __construct()
    {
        add_filter('woocommerce_email_attachments', [$this, 'attachmentFile'], 10, 3);
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

        $user = new User();
        $userAddress = (strlen($order->getAddress()) < 10) ? get_user_meta($user->getUser()->ID, 'adress',
            true) : $order->getAddress();
        $address = [
            'first_name' => get_user_meta($user->getUser()->ID, 'first_name', true),
            'last_name' => get_user_meta($user->getUser()->ID, 'last_name', true),
            'company' => get_user_meta($user->getUser()->ID, 'nameur', true),
            'address_1' => $userAddress,
        ];

        $wcOrder = wc_create_order();

        update_post_meta($wcOrder->get_id(), 'is_delivery', $order->isDelivery());
        update_post_meta($wcOrder->get_id(), 'payment_method', $order->getPayment());
        if ($user->getGroup() === 'mixed') {
            update_post_meta($wcOrder->get_id(), 'user_group', $user->getGroupMixed());
        } else {
            update_post_meta($wcOrder->get_id(), 'user_group', $user->getGroup());
        }
        $userGroup = ($user->getGroup() === 'mixed') ? $user->getGroupMixed() : $user->getGroup();

        $wcOrder->set_customer_id($user->getUser()->ID);
        if ($order->getComment()) {
            $wcOrder->add_order_note($order->getComment(), $user->getUser()->ID, true);
        }

        foreach ($cart->items() as $item) {
            $product = new Product(get_post($item['product_id']));
            $price = ($userGroup === 'cash') ? $product->getPriceForCash() : $product->getPriceForCashless();
            $total = $price * $item['quantity'];
            $itemId = $wcOrder->add_product(wc_get_product($item['product_id']), $item['quantity'], [
                'subtotal' => $total,
                'total' => $total
            ]);
            wc_add_order_item_meta($itemId, '_product_rrp', $product->rrp);
            wc_add_order_item_meta($itemId, '_comment', $item['comment']);
        }
        $wcOrder->set_address($address, 'billing');
        $wcOrder->update_status('processing');
        $wcOrder->calculate_totals();

        WC()->cart->empty_cart();

        return [
            'success' => true,
            'url' => wc_get_checkout_url().'?order-received='.$wcOrder->get_id().'&key='.$wcOrder->get_order_key()
        ];
    }

    /**
     * Прикрепляем файл с детализацией заказа к письму
     * @param $attachments array
     * @param $id string Maybe values: new_order (for admin), customer_invoice (for client)
     * @param $object \WC_Order
     */
    public function attachmentFile($attachments, $id, $object)
    {
        if ($object instanceof \WC_Order) {
            $position = 2;

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $writer = new Xlsx($spreadsheet);
            $sheet->setCellValue('A1', '#');

            $productIncrement = 0;
            foreach ($object->get_items() as $item) {
                $productIncrement++;
                $letter = 'B';
                $userType = ($id === 'new_order') ? 'forAdmin' : 'forClient';

                $fields = new Fields($object->get_id(), $item->get_data()['product_id']);
                $fieldsWhere = collect($fields->fields())->where($userType, true)->all();

                $sheet->setCellValue('A' . $position, $productIncrement);

                foreach ($fieldsWhere as $field) {
                    if ($position === 2) {
                        $sheet->setCellValue($letter. 1, $field['title']);
                    }
                    $cell = $letter.$position;
                    $sheet->setCellValue($cell, $field['value']);
                    $letter++;
                }
                $position++;
            }

            $writer->save('order.xlsx');

            $attachments[] = 'order.xlsx';
        }

        return $attachments;
    }
}
