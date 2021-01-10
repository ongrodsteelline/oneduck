<?php

namespace App\Modules\Woocommerce;

use App\Modules\Woocommerce\Cart\Cart;

class ShopController
{
    public function __construct()
    {
        add_action('pre_get_posts', [$this, 'queryFilter']);
        add_filter('posts_clauses', [$this, 'filterByTax'], 1, 2);
    }

    /*
     * Исправляем проблему с пагинацией WC
     * */
    public function queryFilter(\WP_Query $query)
    {
        if (!is_admin() && (is_shop() || is_product_category())) {
            $limit = ($_COOKIE['cf_catalog_limit']) ? $_COOKIE['cf_catalog_limit'] : (int) get_option('posts_per_page');
            $query->set('posts_per_page', $limit);
        }
    }

    /*
     * Фильтр по таксономиям
     * */
    public function filterByTax($clauses, $wp_query)
    {
        global $wpdb;

        if (is_admin() && !wp_doing_ajax()) {
            return $clauses;
        }

        $taxonomies = ['product_brand'];

        if (!isset($wp_query->query['orderby']) || !is_array($wp_query->query['orderby'])) {
            return $clauses;
        }

        $taxOrder = $wp_query->query['orderby'];
        $orderKey = array_key_first($taxOrder);
        $orderSort = current($taxOrder);

        if (in_array($orderKey, $taxonomies)) {
            $clauses['join'] .= "
            LEFT OUTER JOIN {$wpdb->term_relationships} AS rel2 ON {$wpdb->posts}.ID = rel2.object_id
            LEFT OUTER JOIN {$wpdb->term_taxonomy} AS tax2 ON rel2.term_taxonomy_id = tax2.term_taxonomy_id
            LEFT OUTER JOIN {$wpdb->terms} USING (term_id)
        ";
            $sourceOrderBy = $clauses['orderby'];
            $clauses['where'] .= " AND (taxonomy = '".$orderKey."' OR taxonomy IS NULL)";
            $clauses['groupby'] = "rel2.object_id";
            $clauses['orderby'] = "GROUP_CONCAT({$wpdb->terms}.name ORDER BY name ASC) ";
            $clauses['orderby'] .= ('ASC' == strtoupper($orderSort)) ? 'ASC' : 'DESC';
            $clauses['orderby'] .= ($sourceOrderBy) ? ', '.$sourceOrderBy : null;

            return $clauses;
        } else {
            return $clauses;
        }
    }
}