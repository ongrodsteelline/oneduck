<?php

namespace App\Modules\Wordpress;

class Helper
{
    public static function disableCacheResponse()
    {
        header("Cache-Control: no-cache, no-store, must-revalidate");
        header("Pragma: no-cache");
        header("Expires: 0 ");
    }

    public static function getTaxonomyHierarchy($taxonomy, $parent = 0)
    {
        $taxonomy = is_array($taxonomy) ? array_shift($taxonomy) : $taxonomy;
        $terms = get_terms([
            'taxonomy' => $taxonomy,
            'parent' => $parent,
            'hide_empty' => false
        ]);

        $children = [];
        foreach ($terms as $term) {
            $term->children = self::getTaxonomyHierarchy($taxonomy, $term->term_id);
            $children[$term->term_id] = $term;
        }

        return $children;
    }
}
