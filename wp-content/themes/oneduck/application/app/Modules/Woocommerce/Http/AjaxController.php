<?php

namespace App\Modules\Woocommerce\Http;

use App\Core\Ajax;
use App\Modules\Woocommerce\Cart\Cart;
use App\Modules\Woocommerce\Filter\Filter;
use App\Modules\Woocommerce\Helpers\CatalogView;
use App\Modules\Woocommerce\Helpers\Helper;
use App\Modules\Woocommerce\Helpers\ProductsQuery;
use Illuminate\Http\Request;
use WP_Query;

class AjaxController
{
    public function __construct()
    {
        Ajax::listen('get_products', [$this, 'getProducts']);
        Ajax::listen('search', [$this, 'search']);
        Ajax::listen('switch_catalog_column', [$this, 'switchCatalogColumn'], 'yes');
        Ajax::listen('store_user_warehouses', [$this, 'storeUserWarehouses']);
    }

    public function getProducts()
    {
        $request = request();

        $catalogView = new CatalogView();

        $productsQuery = new ProductsQuery();

        if ($request->get('type') === 'category') {
            $productsQuery = $productsQuery->setCategoy($request->get('category_id'));
            $categoryQuery = $productsQuery->get();
            $totalFound = $categoryQuery->totalFound();
        }

        if ($request->get('type') === 'brand') {
            $productsQuery = $productsQuery->setBrand($request->get('brand_id'));
        }

        if ($request->get('search')) {
            $productsQuery->setSearch($request->get('search'));
        }

        if ($request->get('filter') && is_array($request->get('filter'))) {
            global $wpdb;

            $taxQuery = [
                'filter' => [
                    'relation' => 'AND'
                ]
            ];

            foreach ($request->get('filter') as $key => $selected) {
                $attribute = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}woocommerce_attribute_taxonomies WHERE attribute_name = '%s'",
                    $key));

                if (is_array($selected) && $attribute->attribute_type === 'select') {
                    $taxQuery['filter'][] = [
                        'taxonomy' => 'pa_' . $key,
                        'field' => 'id',
                        'terms' => $selected,
                        'operator' => 'IN'
                    ];
                } else if ($attribute->attribute_type === 'toggle') {
                    $taxQuery['filter'][] = [
                        'taxonomy' => 'pa_' . $key,
                        'operator' => 'EXISTS'
                    ];
                }
            }

            $productsQuery->setTaxQuery($taxQuery);
        }

        $metaQuery = [
            'stock' => [
                'key' => '_stock',
                'compare' => 'EXISTS',
                'type' => 'DECIMAL'
            ],
            'price' => [
                'key' => '_regular_price',
                'compare' => 'EXISTS',
                'type' => 'DECIMAL'
            ]
        ];

        $productsQuery = $productsQuery->setMetaQuery($metaQuery);

        if ($request->get('order')) {
            $productsQuery = $productsQuery->setOrder($request->get('order'));
        }

        $productsQuery = $productsQuery->setPage($request->get('paged'))->setLimit($request->get('limit'))->get();

        wp_send_json([
            'products' => $productsQuery->products(),
            'pagination' => $catalogView->getPagination($productsQuery->totalFound(), $request->get('paged')),
            'counter' => [
                'all' => (isset($totalFound)) ? $totalFound : $productsQuery->totalFound(),
                'filter' => ($request->get('filter') || $request->get('search')) ? $productsQuery->totalFound() : 0
            ]
        ]);
    }

    public function search()
    {
        $request = request();

        $categories = [];
        $categoriesQuery = get_terms('product_cat', array(
            'number' => 5,
            'name__like' => $request->get('query'),
            'hide_empty' => false
        ));

        foreach ($categoriesQuery as $category) {
            $categories[] = [
                'name' => $category->name,
                'url' => get_term_link($category)
            ];
        }

        $products = [];
        $productsQuery = new WP_Query([
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => 15,
            's' => $request->get('query')
        ]);

        foreach ($productsQuery->posts as $post) {
            $products[] = [
                'name' => $post->post_title,
                'url' => get_permalink($post)
            ];
        }

        $total = $productsQuery->found_posts + count($categories);

        wp_send_json([
            'products' => $products,
            'categories' => $categories,
            'total' => $total
        ]);
    }

    public function switchCatalogColumn()
    {
        $request = request();
        $user = wp_get_current_user();

        update_user_meta($user->ID, 'hidden_catalog_columns', $request->get('columns'));

        wp_send_json_success();
    }

    public function storeUserWarehouses()
    {
        $request = request();

        Helper::storeSelectedWarehouses($request->get('warehouses'));

        wp_send_json_success();
    }
}
