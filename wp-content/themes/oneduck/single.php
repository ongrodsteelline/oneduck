<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package oneduck
 */

get_header();
?>

		<?php
				while ( have_posts() ) :
					the_post();
					if (is_singular('stocks')) {
						get_template_part( 'template-parts/content-stock', get_post_type() );
					}
				?>

		<?php endwhile; ?>

<?php
get_footer();
