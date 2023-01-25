<?php

namespace App\Modules\Woocommerce\Helpers;

use App\Modules\Woocommerce\Models\Product;
use WP_Query;

class ProductsQuery
{
    public $args = [];
    public $query;
    public $products;
    public $totalFound = 0;

    public function get()
    {
        $args = [
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => 10,
            'orderby' => [
                'product_warehouse' => 'DESC'
            ],
            'tax_query' => []
        ];

        $args = array_replace($args, $this->args);

        $this->query = new WP_Query($args);

        $this->products = $this->schemaProducts($this->query->get_posts());
        $this->totalFound = $this->query->found_posts;

        return $this;
    }

    /**
     * @return Product[]
     * */
    public function products()
    {
        return $this->products;
    }

    public function totalFound()
    {
        return $this->totalFound;
    }

    protected function schemaProducts(array $posts)
    {
        $products = [];

        foreach ($posts as $post) {
            $product = new Product($post);
            $products[] = $product;
        }

        return $products;
    }

    /**
     * @param array|string $status
     */
    public function setStatus($status)
    {
        $this->args['post_status'] = $status;

        return $this;
    }

    /**
     * @param $category array|string
     * @return $this
     */
    public function setCategoy($category)
    {
        $this->args['tax_query'][] = [
            'taxonomy' => 'product_cat',
            'field' => 'id',
            'terms' => $category,
        ];

        return $this;
    }

    public function setBrand($brand)
    {
        $this->args['tax_query'][] = [
            'taxonomy' => 'product_brand',
            'field' => 'id',
            'terms' => $brand,
        ];

        return $this;
    }

    public function setSku($sku)
    {
        $this->args['sku'] = $sku;

        return $this;
    }

    public function setPage($page)
    {
        $this->args['paged'] = $page;

        return $this;
    }

    public function setLimit($quantity)
    {
        $this->args['posts_per_page'] = $quantity;

        return $this;
    }

    public function setOffset($offset)
    {
        $this->args['offset'] = $offset;

        return $this;
    }

    public function setOrder($order)
    {
        $this->args['orderby'] = $order;

        return $this;
    }

    public function setMetaQuery($query)
    {
        $this->args['meta_query'] = $query;

        return $this;
    }

    public function setTaxQuery($query)
    {
        $this->args['tax_query'] = array_merge($query, $this->args['tax_query'] ?? []);

        return $this;
    }

    public function setSearch($query)
    {
        $this->args['s'] = $query;
        $this->args['s_meta_keys'] = ['shk1', 'shk2', 'shk3'];

        return $this;
    }

    /*
     * Игнорируем лимит заданный через куки
     * */
    public function setIgnoreCookieLimit()
    {
        $this->args['ignore_cookie_limit'] = 1;
        return $this;
    }
}
