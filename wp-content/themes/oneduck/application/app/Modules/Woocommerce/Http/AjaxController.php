<?php

namespace App\Modules\Woocommerce\Http;

use App\Core\Ajax;
use App\Modules\Woocommerce\Cart\Cart;
use App\Modules\Woocommerce\Helpers\CatalogView;
use App\Modules\Woocommerce\Helpers\ProductsQuery;
use Illuminate\Http\Request;

class AjaxController
{
    public function __construct()
    {
        Ajax::listen('get_products', [$this, 'getProducts']);
        Ajax::listen('search', [$this, 'search']);
    }

    public function getProducts()
    {
        $request = request();

        $catalogView = new CatalogView();

        $productsQuery = new ProductsQuery();
        if ($request->get('type') === 'category') {
            $productsQuery = $productsQuery->setCategoy($request->get('category_id'));
        }

        $productsQuery = $productsQuery->setMetaQuery([
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
        ]);

        if ($request->get('order')) {
            $productsQuery = $productsQuery->setOrder($request->get('order'));
        }

        $productsQuery = $productsQuery->setPage($request->get('paged'))->setLimit($request->get('limit'))->get();

        wp_send_json([
            'products' => $productsQuery->products(),
            'pagination' => $catalogView->getPagination($productsQuery->totalFound(), $request->get('paged'))
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
        $productsQuery = new \WP_Query([
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

        $total = $productsQuery->found_posts;

        wp_send_json([
            'products' => $products,
            'categories' => $categories,
            'total' => $total
        ]);
    }
}