<?php

namespace App\Modules\Woocommerce\Filter;

class AttributesField extends \acf_field_checkbox
{
    public function initialize()
    {
        $this->name = 'woo_attributes';
        $this->label = 'Woocommerce Attributes';
        $this->category = 'relational';
        $this->defaults = [
            'layout' => 'vertical',
            'choices' => [],
            'default_value' => '',
            'allow_custom' => 0,
            'save_custom' => 0,
            'toggle' => 0,
            'return_format' => 'value'
        ];

        $attributes = wc_get_attribute_taxonomies();

        foreach ($attributes as $attribute) {
            $this->defaults['choices'][$attribute->attribute_name] = $attribute->attribute_label;
        }
    }

    public function walk($choices = [], $args = [], $depth = 0)
    {
        $args['type'] = 'checkbox';

        return parent::walk($choices, $args, $depth);
    }
}
