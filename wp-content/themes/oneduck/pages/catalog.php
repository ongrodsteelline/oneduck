<?php

use App\Modules\Woocommerce\Filter\Filter;
use App\Modules\Woocommerce\Helpers\ProductsQuery;
use App\Modules\Woocommerce\Helpers\CatalogView;
use App\Modules\Wordpress\Helper;

Helper::disableCacheResponse();

global $wp_query;

$catalogView = new CatalogView();

$productsQuery = new ProductsQuery();
if ($catalogView->isCategory()) {
    $productsQuery = $productsQuery->setCategoy($catalogView->getId());
}

$metaQuery = [
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
];
$productsQuery = $productsQuery->setMetaQuery($metaQuery);

$productsQuery = $productsQuery->setPage($catalogView->getPaged())
    ->setLimit($catalogView->getLimit())
    ->setOrder($catalogView->getOrder())
    ->get();

$filter = new Filter($catalogView);
$attributes = $filter->getAttributes();

echo view('catalog.index', [
    'type' => $catalogView->isCategory() ? 'category' : 'catalog',
    'categoryId' => $catalogView->getId(),
    'title' => $catalogView->getName(),
    'description' => $catalogView->getDescription(),
    'products' => $productsQuery->products(),
    'attributes' => $attributes,
    'paged' => $catalogView->getPaged(),
    'pagination' => $catalogView->getPagination($productsQuery->totalFound(), $catalogView->getPaged()),
    'breadcrumbs' => $catalogView->getBreadcrumbs(),
    'parentCategory' => $catalogView->getParentCategory(),
    'limit' => $catalogView->getLimit(),
    'counter' => [
        'all' => $productsQuery->totalFound(),
        'filter' => 0
    ]
]);
