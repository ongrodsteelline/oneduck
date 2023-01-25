<?php

use App\Modules\Woocommerce\Helpers\CatalogView;
use App\Modules\Woocommerce\Helpers\ProductsQuery;
use App\Modules\Wordpress\Helper;

Helper::disableCacheResponse();

$catalogView = new CatalogView();

$productsQuery = new ProductsQuery();
$productsQuery = $productsQuery->setBrand($catalogView->getBrand()->term_id);

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

$productsQuery = $productsQuery->setPage($catalogView->getPaged())
    ->setLimit($catalogView->getLimit())
    ->setOrder($catalogView->getOrder())
    ->get();

echo view('brand.index', [
    'title' => $catalogView->getBrand()->name,
    'products' => $productsQuery->products(),
    'brandId' => $catalogView->getBrand()->term_id
]);
