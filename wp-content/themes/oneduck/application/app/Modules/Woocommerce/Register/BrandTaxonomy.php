<?php

namespace App\Modules\Woocommerce\Register;

use App\Core\Wordpress\RegisterTaxonomy;

class BrandTaxonomy
{
    public function __construct()
    {
        add_action('init', function () {
            $tax = new RegisterTaxonomy('product_brand', 'Бренд', 'Бренды');
            $tax->setPostTypes(['product'])->hideMetabox()->register();
        });
    }
}