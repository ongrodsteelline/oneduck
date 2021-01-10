<?php

namespace App\Modules\Woocommerce\Helpers;

use App\Helpers\Breadcrumbs;
use App\Modules\Woocommerce\Models\Product;

class ProductView
{
    protected $post;
    protected $product;

    public function __construct(\WP_Post $post, Product $product)
    {
        $this->post = $post;
        $this->product = $product;
    }

    public function getBreadcrumbs()
    {
        $breadcrumbs = new Breadcrumbs();

        $ancestors = get_ancestors($this->product->category[0]->term_id, 'product_cat');
        $ancestors = array_reverse($ancestors);

        foreach ($ancestors as $ancestor) {
            $category = get_term($ancestor);
            $breadcrumbs->addItem($category->name, get_term_link($category));
        }

        $breadcrumbs->addItem($this->product->category[0]->name, get_term_link($this->product->category[0]));

        return $breadcrumbs->get();
    }
}