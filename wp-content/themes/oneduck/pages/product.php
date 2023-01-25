<?php

use App\Modules\Wordpress\Helper;

Helper::disableCacheResponse();

global $post;

use App\Modules\Woocommerce\Helpers\ProductView;
use App\Modules\Woocommerce\Models\Product;

$product = new Product($post);
$productView = new ProductView($post, $product);

echo view('product.index', [
    'product' => $product,
    'breadcrumbs' => $productView->getBreadcrumbs()
]);
