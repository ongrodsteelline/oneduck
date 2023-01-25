<?php

namespace App\Modules\Woocommerce;

use App\Modules\Woocommerce\Helpers\Helper;
use App\Modules\Woocommerce\OrderHistory\OrderHistory;
use WP_Query;

class ShopController
{
    public function __construct()
    {
        add_action('pre_get_posts', [$this, 'queryFilter']);
        add_filter('posts_clauses', [$this, 'filterByTax'], 10, 2);
    }

    /*
     * Исправляем проблему с пагинацией WC
     * */
    public function queryFilter(WP_Query $query)
    {
        if ($query->get('ignore_cookie_limit') !== 1 && !is_admin() && (is_shop() || is_product_category())) {
            $limit = ($_COOKIE['cf_catalog_limit']) ? $_COOKIE['cf_catalog_limit'] : (int)get_option('posts_per_page');
            $query->set('posts_per_page', $limit);
        }

        if ($query->is_search() && $query->query_vars && $query->query_vars['s'] && $query->query_vars['s_meta_keys']) {
            global $wpdb;
            $search = $query->query_vars['s'];
            $ids = array();
            foreach (explode(' ', $search) as $term) {
                $term = trim($term);
                if (!empty($term)) {
                    $query_posts = $wpdb->prepare("SELECT * FROM {$wpdb->posts} WHERE post_status='publish' AND ((post_title LIKE '%%%s%%') OR (post_content LIKE '%%%s%%'))",
                        $term, $term);
                    $ids_posts = [];
                    $results = $wpdb->get_results($query_posts);
                    if ($wpdb->last_error) {
                        die($wpdb->last_error);
                    }
                    foreach ($results as $result) {
                        $ids_posts[] = $result->ID;
                    }
                    $query_meta = [];
                    foreach ($query->query_vars['s_meta_keys'] as $meta_key) {
                        $query_meta[] = $wpdb->prepare("meta_key='%s' AND meta_value LIKE '%%%s%%'", $meta_key, $term);
                    }
                    $query_metas = $wpdb->prepare("SELECT * FROM {$wpdb->postmeta} WHERE ((" . implode(') OR (',
                            $query_meta) . "))");
                    $ids_metas = [];
                    $results = $wpdb->get_results($query_metas);
                    if ($wpdb->last_error) {
                        die($wpdb->last_error);
                    }
                    foreach ($results as $result) {
                        $ids_metas[] = $result->post_id;
                    }
                    $merged = array_merge($ids_posts,
                        $ids_metas);
                    $unique = array_unique($merged);
                    if (!$unique) {
                        $unique = array(0);
                    }
                    $ids[] = $unique;
                }
            }
            if (count($ids) > 1) {
                $intersected = call_user_func_array('array_intersect', $ids);
            } else {
                $intersected = $ids[0];
            }
            $unique = array_unique($intersected);
            if (!$unique) {
                $unique = array(0);
            }
            unset($query->query_vars['s']);
            $query->set('post__in', $unique);
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

        if (!isset($wp_query->query['orderby']) || !is_array($wp_query->query['orderby'])) {
            return $clauses;
        }

        $taxOrder = $wp_query->query['orderby'];
        $orderSort = current($taxOrder);

        if (array_key_exists('product_brand', $taxOrder)) {
            $clauses['join'] .= "
            LEFT OUTER JOIN {$wpdb->term_relationships} AS rel2 ON {$wpdb->posts}.ID = rel2.object_id
            LEFT OUTER JOIN {$wpdb->term_taxonomy} AS tax2 ON rel2.term_taxonomy_id = tax2.term_taxonomy_id
            LEFT OUTER JOIN {$wpdb->terms} USING (term_id)
        ";
            $sourceOrderBy = $clauses['orderby'];
            $clauses['where'] .= " AND (taxonomy = 'product_brand' OR taxonomy IS NULL)";
            $clauses['groupby'] = "rel2.object_id";
            $clauses['orderby'] = "GROUP_CONCAT({$wpdb->terms}.name ORDER BY name ASC) ";
            $clauses['orderby'] .= ('ASC' == strtoupper($orderSort)) ? 'ASC' : 'DESC';
            $clauses['orderby'] .= ($sourceOrderBy) ? ', ' . $sourceOrderBy : null;
        }

        if (array_key_exists('product_warehouse', $taxOrder)) {
            Helper::getWarehouses();
            $queryWarehouses = [];
            foreach (Helper::getSelectedWarehouses() as $warehouseId) {
                $queryWarehouses[] = "`meta_value` LIKE '%{$warehouseId}%'";
            }
            $queryWarehouses = implode(' OR ', $queryWarehouses);
            if ($queryWarehouses) {
                $clauses['fields'] .= ",(SELECT COUNT(*) FROM duck_postmeta WHERE `post_id` = duck_posts.ID AND `meta_key` = 'warehouses' AND ({$queryWarehouses})) total_warehouses";
                $clauses['orderby'] .= 'total_warehouses DESC';
            }
        }

        return $clauses;
    }
}
