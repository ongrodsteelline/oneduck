<?php

namespace App\Modules\Woocommerce\Filter;

use App\Modules\Woocommerce\Models\Product;

class Admin
{
    public function __construct()
    {
        add_action('woocommerce_product_option_terms', [$this, 'displayCheckboxAttribute'], 10, 2);
        add_filter('product_attributes_type_selector', [$this, 'registerAttributeTypes']);
        add_action('add_meta_boxes', [$this, 'registerPriceMetaBox']);
        add_action('acf/include_field_types', [$this, 'registerAcfField']);
    }

    public function registerAcfField()
    {
        new AttributesField();
    }

    public function registerAttributeTypes()
    {
        $types = [
            'select' => 'Мультивыбор',
            'toggle' => 'Переключатель'
        ];

        return $types;
    }

    /*
     * Выводим чекбокс для атрибута с типом чекбокс в редактирование атрибутов товара
     * */
    public function displayCheckboxAttribute($attribute, $i)
    {
        if ($attribute->attribute_type === 'toggle') {
            echo '<label><input type="checkbox" class="checkbox" checked="checked" name="attribute_values['.$i.']" value="1"> Включить</label>';
        }
    }

    public function registerPriceMetaBox()
    {
        add_meta_box('cf_product_price', 'Рассчитанная стоимость', [$this, 'registerPriceMetaBoxCallback'], ['product'], 'side');
    }

    public function registerPriceMetaBoxCallback($post)
    {
        $product = new Product($post);

        echo view('admin.price-metabox', [
            'cash' => $product->getPriceForCash(),
            'cashless' => $product->getPriceForCashless(),
            'rrp' => $product->rrp
        ]);
    }
}
