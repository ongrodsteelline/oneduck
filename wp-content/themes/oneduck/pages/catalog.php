<?php

use App\Modules\Woocommerce\Helpers\ProductsQuery;
use Jaybizzle\CrawlerDetect\CrawlerDetect;
use App\Modules\Woocommerce\Helpers\CatalogView;
use App\Modules\Wordpress\Helper;

Helper::disableCacheResponse();

global $wp_query;

$crawlerDetect = new CrawlerDetect();
$catalogView = new CatalogView();

$productsQuery = new ProductsQuery();
if ($catalogView->isCategory()) {
    $productsQuery = $productsQuery->setCategoy($catalogView->getId());
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

$productsQuery = $productsQuery->setPage($catalogView->getPaged())
    ->setLimit($catalogView->getLimit())
    ->setOrder($catalogView->getOrder())
    ->get();

echo view('catalog.index', [
    'type' => $catalogView->isCategory() ? 'category' : 'catalog',
    'categoryId' => $catalogView->getId(),
    'title' => $catalogView->getName(),
    'description' => $catalogView->getDescription(),
    'products' => $productsQuery->products(),
    'paged' => $catalogView->getPaged(),
    'pagination' => $catalogView->getPagination($productsQuery->totalFound(), $catalogView->getPaged()),
    'breadcrumbs' => $catalogView->getBreadcrumbs(),
    'limit' => $catalogView->getLimit(),
    'isCrawler' => $crawlerDetect->isCrawler()
]);
