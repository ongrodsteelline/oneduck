<?php
/**
 * 
 * Подключение jQuery
 */

// add_action( 'wp_enqueue_scripts', 'my_jquery' );
// function my_jquery() {
// 	// отменяем зарегистрированный jQuery
// 	// вместо "jquery-core", можно вписать "jquery", тогда будет отменен еще и jquery-migrate
// 	wp_deregister_script( 'jquery-core' );
// 	wp_register_script( 'jquery-core', 'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js');
// 	wp_enqueue_script( 'jquery' );
// }

/**
 * Подключение стилей и скриптов
 */
add_action( 'wp_enqueue_scripts', 'newoneduck_scripts' );
function newoneduck_scripts() {
    wp_enqueue_style( 'style-bootstrap', get_template_directory_uri() . '/app/assets/css/bootstrap.min.css' );
    wp_enqueue_style( 'style-swiper', get_template_directory_uri() . '/app/assets/css/swiper.min.css' );
	wp_enqueue_style( 'style-main', get_template_directory_uri() . '/app/assets/css/main/styles.css' );
	wp_enqueue_style( 'style-media', get_template_directory_uri() . '/app/assets/css/main/media.css' );

	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/app/assets/js/libs/jquery-1.11.0.min.js', array(), '1.0.0', true );
	wp_enqueue_script( 'popper', get_template_directory_uri() . '/app/assets/js/libs/popper.min.js', array(), '1.0.0', true );
	wp_enqueue_script( 'script-bootstrap', get_template_directory_uri() . '/app/assets/js/libs/bootstrap.min.js', array(), '1.0.0', true );
	wp_enqueue_script( 'script-lightbox', get_template_directory_uri() . '/app/assets/js/libs/ekko-lightbox.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'script-swiper', get_template_directory_uri() . '/app/assets/js/libs/swiper.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'script-panzoom', get_template_directory_uri() . '/app/assets/js/libs/panzoom.min.js', array(), '1.0.0', true );
	wp_enqueue_script( 'script-main', get_template_directory_uri() . '/app/dest/js/main.js', array(), '1.0.0', true );
}


?>