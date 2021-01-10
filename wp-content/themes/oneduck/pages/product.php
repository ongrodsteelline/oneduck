<?php

use App\Modules\Wordpress\Helper;

Helper::disableCacheResponse();

global $post;

use App\Modules\Woocommerce\Helpers\ProductView;
use App\Modules\Woocommerce\Models\Product;
use Jaybizzle\CrawlerDetect\CrawlerDetect;

$product = new Product($post);
$productView = new ProductView($post, $product);
$crawlerDetect = new CrawlerDetect();

echo view('product.index', [
    'product' => $product,
    'breadcrumbs' => $productView->getBreadcrumbs(),
    'isCrawler' => $crawlerDetect->isCrawler()
]);