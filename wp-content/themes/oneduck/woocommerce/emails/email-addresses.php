<?php
/**
 * Email Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-addresses.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 3.9.0
 */
/* @var $order WC_Order */

if (!defined('ABSPATH')) {
    exit;
}

$text_align = is_rtl() ? 'right' : 'left';
$address = $order->get_formatted_billing_address();
$shipping = $order->get_formatted_shipping_address();

?>
<table id="addresses" cellspacing="0" cellpadding="0"
       style="width: 100%; vertical-align: top; margin-bottom: 40px; padding:0;" border="0">
    <tr>
        <td style="text-align:<?php echo esc_attr($text_align); ?>; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; border:0; padding:0;"
            valign="top" width="50%">
            <h2><?php esc_html_e('Billing address', 'woocommerce'); ?></h2>

            <address class="address">
                <?php echo wp_kses_post($address ? $address : esc_html__('N/A', 'woocommerce')); ?>
                <?php if ($order->get_billing_phone()) : ?>
                    <br/><?php echo wc_make_phone_clickable($order->get_billing_phone()); ?>
                <?php endif; ?>
                <?php if ($order->get_billing_email()) : ?>
                    <br/><?php echo esc_html($order->get_billing_email()); ?>
                <?php endif; ?>

                <?php
                $isDelivery = get_post_meta($order->get_id(), 'is_delivery', true);
                $isDeliveryFormatted = ($isDelivery) ? 'Да' : 'Нет';

                $paymentMethods = [
                    'first' => 'Первая форма',
                    'second' => 'Вторая форма',
                    'mixed' => 'Смешанная форма'
                ];
                $payment = get_post_meta($order->get_id(), 'payment_method', true);
                ?>
                <br>
                <div><strong>Нужна доставка?:</strong> <?= $isDeliveryFormatted ?></div>
                <div><strong>Способ доставки:</strong> <?= $paymentMethods[$payment] ?></div>
                <?php
                if (!empty($order->get_customer_order_notes())) {
                    ?>
                    <div><strong>Комментарий:</strong> <?= last($order->get_customer_order_notes())->comment_content ?>
                    </div>
                    <?php
                }
                ?>
            </address>
        </td>
    </tr>
</table>
