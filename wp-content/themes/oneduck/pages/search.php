<?php
/* Template Name: Search */

$request = request();

$categories = [];
$products = [];

if ($request->get('q')) {
    $categoriesQuery = get_terms('product_cat', array(
        'name__like' => $request->get('q'),
        'hide_empty' => false
    ));

    foreach ($categoriesQuery as $category) {
        $categories[] = [
            'name' => $category->name,
            'url' => get_term_link($category)
        ];
    }

    $productsQuery = new \WP_Query([
        'post_type' => 'product',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        's' => $request->get('q')
    ]);

    foreach ($productsQuery->posts as $post) {
        $products[] = [
            'name' => $post->post_title,
            'url' => get_permalink($post)
        ];
    }
}

echo view('search.index', [
    'query' => $request->get('q'),
    'categories' => $categories,
    'products' => $products
]);