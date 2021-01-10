<?php

namespace App\Modules\Woocommerce\Helpers;

use App\Modules\Woocommerce\Models\Product;

class ProductsQuery
{
    protected $args = [];
    protected $query;
    protected $products;
    protected $totalFound = 0;

    public function get()
    {
        $args = [
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => 10,
            'orderby' => [],
            'tax_order' => []
        ];

        $args = array_replace($args, $this->args);

        $this->query = new \WP_Query($args);

        $this->products = $this->schemaProducts($this->query->get_posts());
        $this->totalFound = $this->query->found_posts;

        return $this;
    }

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
     * @param  array|string  $status
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

    public function setTaxOrder($order)
    {
        $this->args['tax_order'] = $order;

        return $this;
    }
}