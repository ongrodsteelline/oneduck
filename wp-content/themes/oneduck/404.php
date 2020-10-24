<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package oneduck
 */

get_header();
?>
<style>
	.error-style {
		text-align: center;
		margin-top: 250px;
	}
	.error-style a {
		text-decoration: underline;
	}
</style>

<section class="error-style">
	<div class="container">
		<h1>Упс, страница не найдена. Вы можете перейти на <a href="/">Главную</a>.</h1>
	</div>
</section>

<?php
get_footer();
