<?php
/**
 * Template Name: Stock
 */

get_header();
?>

<main class="main">
          <section class="stock">
            <h1><?php the_title(); ?></h1>
            <div class="stock__wrap">
            <?php
                $args = array(
                    'post_type' => 'stocks',
                    'posts_per_page' => 50
                );                
                $query = new WP_Query( $args );

                if ( $query->have_posts() ) {
                    while ( $query->have_posts() ) {
                        $query->the_post();
                        $view_stock = get_field('view_stock');
                        ?>
                        <div class="stock__block <?php if($view_stock != 'До') : echo 'stock__block_disabled'; endif; ?>">
                        <a href="<?php echo get_the_permalink(); ?>">
                            <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                            <p><?php the_title(); ?></p>
                        </a>
                        <div class="stock__block__acts">
                            <?php if($view_stock == 'До') {  ?>
                                <span></span>
                                <?php the_field('do_stock'); ?>
                            <?php } else { ?>
                            <?php echo 'завершена'; } ?>
                        </div>
                        </div><!-- /stock__block -->
                                <?php
                            }
                        } else {
                            echo 'Акций не найдено!';
                        }
                        wp_reset_postdata();
                    ?>
            </div>
          </section><!-- /stock -->
      </main>


<?php get_footer(); ?>