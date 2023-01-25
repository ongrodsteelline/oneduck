<?php

namespace App\Modules\Woocommerce\Filter;

use App\Modules\Woocommerce\Helpers\CatalogView;

class Filter
{
    public $catalogView;

    public function __construct(CatalogView $catalogView)
    {
        $this->catalogView = $catalogView;
    }

    public function getAttributes($category = null)
    {
        $i = 0;
        $attributes = [];
        $taxonomies = wc_get_attribute_taxonomies();

        if ($category === null) {
            $category = $this->catalogView->getCategory();
        }

        if (!$this->catalogView->isCategory()) {
            foreach ($taxonomies as $tax) {
                $attributes[$i] = [
                    'id' => $tax->attribute_id,
                    'slug' => $tax->attribute_name,
                    'name' => $tax->attribute_label,
                    'type' => $tax->attribute_type,
                    'items' => []
                ];

                $children = get_terms([
                    'taxonomy' => 'pa_' . $tax->attribute_name,
                    'hide_empty' => false
                ]);

                foreach ($children as $child) {
                    $attributes[$i]['items'][] = [
                        'id' => $child->term_id,
                        'name' => $child->name
                    ];
                }

                $i++;
            }

            return $attributes;
        }

        $categoryFilters = get_field('filter_setup', $category);

        if ($categoryFilters) {
            foreach ($taxonomies as $tax) {
                if (in_array($tax->attribute_name, $categoryFilters)) {
                    $attributes[$i] = [
                        'id' => $tax->attribute_id,
                        'slug' => $tax->attribute_name,
                        'name' => $tax->attribute_label,
                        'type' => $tax->attribute_type,
                        'items' => []
                    ];

                    $children = get_terms([
                        'taxonomy' => 'pa_' . $tax->attribute_name,
                        'hide_empty' => false
                    ]);

                    foreach ($children as $child) {
                        $attributes[$i]['items'][] = [
                            'id' => $child->term_id,
                            'name' => $child->name
                        ];
                    }

                    $i++;
                }
            }
        } else {
            if ($category->parent > 0) {
                return $this->getAttributes(get_term($category->parent));
            }
        }

        return $attributes;
    }
}
