<?php

namespace App\Modules\Woocommerce;

use App\Core\Wordpress\RegisterTaxonomy;

class Taxonomies
{
    public function __construct()
    {
        add_action('init', function () {
            $brand = new RegisterTaxonomy('product_brand', 'Бренд', 'Бренды');
            $brand->setPostTypes(['product'])->hideMetabox()->register();

            $warehouse = new RegisterTaxonomy('product_warehouse', 'Склад', 'Склады');
            $warehouse->setPostTypes(['product'])->hideMetabox()->register();
        });
    }
}
