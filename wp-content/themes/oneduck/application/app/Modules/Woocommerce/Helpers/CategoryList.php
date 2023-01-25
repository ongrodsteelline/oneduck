<?php

namespace App\Modules\Woocommerce\Helpers;

class CategoryList
{
    public static function getCategories($parent = 0, $lvl = 0, $maxLvl = 5)
    {
        $args = [
            'hide_empty' => false,
            'taxonomy' => 'product_cat',
            'parent' => $parent
        ];

        $categories = get_terms($args);

        if ($lvl === $maxLvl) {
            return $categories;
        }

        foreach ($categories as $category) {
            if ($lvl === 0) {
                $flashEnabled = get_field('flash_state', 'product_cat_' . $category->term_id);
                $category->flash = new \stdClass();
                $category->flash->enabled = $flashEnabled;
                if ($flashEnabled) {
                    $flashText = get_field('flash_description', 'product_cat_' . $category->term_id);
                    $flashLink = get_field('flash_link', 'product_cat_' . $category->term_id);

                    $category->flash->text = $flashText;
                    $category->flash->link = $flashLink;
                }
            }
            $children = self::getCategories($category->term_id, $lvl + 1);
            $category->has_children = (count($children) > 0) ? true : false;
            $category->children = ($category->has_children > 0) ? $children : [];
        }

        return $categories;
    }
}
