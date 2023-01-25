<?php

namespace App\Modules\Woocommerce\Helpers;

use App\Helpers\Breadcrumbs;
use App\Helpers\Paginator;
use App\Modules\Wordpress\Helper as HelperWordpress;

class CatalogView
{
    protected $term;
    protected $page;
    protected $brand;
    protected $products;

    public function __construct()
    {
        if (is_product_category()) {
            $this->term = get_term($GLOBALS['wp_query']->get_queried_object());
        }

        if (is_shop()) {
            $this->page = get_post(wc_get_page_id('shop'));
        }

        if (is_tax('product_brand')) {
            $this->brand = get_term($GLOBALS['wp_query']->get_queried_object());
        }
    }

    public function getCategory()
    {
        return $this->term;
    }

    public function getBrand()
    {
        return $this->brand;
    }

    public function getPage()
    {
        return $this->page;
    }

    public function getId()
    {
        return $this->isCategory() ? $this->term->term_id : $this->page->ID;
    }

    public function getName()
    {
        return $this->isCategory() ? $this->term->name : $this->page->post_title;
    }

    public function getDescription()
    {
        return $this->isCategory() ? $this->term->description : $this->page->post_content;
    }

    public function getPaginateUrl()
    {
        $url = $this->isCategory() ? get_term_link($this->term) : get_permalink($this->page);
        return $url . 'page/(:num)';
    }

    /*
     * Формируем хлебные крошки для дочерних категорий
     * Родительские категории не возвращают хлебные крошки
     * */
    public function getBreadcrumbs()
    {
        if ($this->term) {
            if ($this->term->parent) {
                $breadcrumbs = new Breadcrumbs();

                $ancestors = get_ancestors($this->term->term_id, 'product_cat');
                $ancestors = array_reverse($ancestors);

                foreach ($ancestors as $ancestor) {
                    $category = get_term($ancestor);
                    $breadcrumbs->addItem($category->name, get_term_link($category));
                }

                $breadcrumbs->addItem($this->term->name, get_term_link($this->term), true);

                return $breadcrumbs->get();
            }
        }

        return [];
    }

    public function getAncestors()
    {
        $ancestors = get_ancestors($this->term->term_id, 'product_cat');
        $ancestors = array_reverse($ancestors);

        if (empty($ancestors)) {
            $ancestors = [$this->term->term_id];
        } else {
            $ancestors[] = $this->term->term_id;
        }

        return $ancestors;
    }

    public function getParentCategory()
    {
        $parent = get_term($this->getAncestors()[0]);
        $parent->children = $this->getCategoryNavigation(HelperWordpress::getTaxonomyHierarchy('product_cat', $parent->term_id));

        return $parent;
    }

    public function getCategoryNavigation($terms = [])
    {
        foreach ($terms as $term) {
            if (in_array($term->term_id, $this->getAncestors())) {
                $term->active = true;
            }

            if (count($term->children)) {
                $term->children = $this->getCategoryNavigation($term->children);
            }
        }

        return $terms;
    }

    public function getPagination($total, $paged = 1)
    {
        $paginator = new Paginator($total, $this->getLimit(), $paged, $this->getPaginateUrl());
        return $paginator->getPages();
    }

    public function getPaged()
    {
        return (get_query_var('paged')) ? get_query_var('paged') : 1;
    }

    public function getLimit()
    {
        return ($_COOKIE['cf_catalog_limit']) ? $_COOKIE['cf_catalog_limit'] : get_option('posts_per_page');
    }

    public function getTaxOrder()
    {
        return ($_COOKIE['cf_catalog_tax_order']) ? json_decode(stripslashes($_COOKIE['cf_catalog_tax_order']), true) : [];
    }

    public function getOrder()
    {
        return ($_COOKIE['cf_catalog_order']) ? json_decode(stripslashes($_COOKIE['cf_catalog_order']), true) : [
            'product_warehouse' => 'DESC'
        ];
    }

    public function isCategory()
    {
        return $this->term ? true : false;
    }
}
