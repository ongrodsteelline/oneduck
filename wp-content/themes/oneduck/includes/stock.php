<?php
add_action( 'init', 'true_register_faq' ); // Использовать функцию только внутри хука init
 
function true_register_faq() {
	$labels = array(
		'name' => 'Акции',
		'singular_name' => 'Акции', // админ панель Добавить->Функцию
		'add_new' => 'Добавить акцию',
		'add_new_item' => 'Добавить акцию', // заголовок тега <title>
		'edit_item' => 'Редактировать акцию',
		'new_item' => 'Новая акция',
		'all_items' => 'Все акции',
		'view_item' => 'Просмотр акций на сайте',
		'search_items' => 'Искать акции',
		'not_found' =>  'Акций не найдено.',
		'not_found_in_trash' => 'В корзине нет акций.',
		'menu_name' => 'Акции' // ссылка в меню в админке
	);
	$args = array(
		'labels' => $labels,
		'public' => true, // благодаря этому некоторые параметры можно пропустить
		'menu_icon' => 'dashicons-bell',
		'menu_position' => 6,
		'has_archive' => false,
		'supports' => array( 'title', 'editor', 'thumbnail'),
		'taxonomies' => array('item')
	);
	register_post_type('stocks',$args);
}


?>