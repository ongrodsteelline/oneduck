<?php
/**
 * Template Name: Shop Pay
 */
get_header();
?>

        <main class="main">
          <section class="shopPay">
            <h1><?php the_title(); ?></h1>
            
            <div class="shopPay__wrap">
            <?php $view_pay1 = get_field('view_pay1'); if($view_pay1 == 'Да') : ?>
                <div class="shopPay__block">
                    <div><img src="<?php the_field('pay_img1'); ?>" alt="delivery"></div>
                    <div class="description">
                        <h2><?php the_field('pay_title1'); ?></h2>
                        <?php the_field('pay_editor1'); ?>
                    </div>
                </div><!-- /shopPay__block -->
            <?php endif; ?>
            <?php $view_pay2 = get_field('view_pay2'); if($view_pay2 == 'Да') : ?>
                <div class="shopPay__block">
                    <div><img src="<?php the_field('pay_img2'); ?>" alt="delivery"></div>
                    <div class="description">
                        <h2><?php the_field('pay_title2'); ?></h2>
                        <?php the_field('pay_editor'); ?>
                    </div>
                </div><!-- /shopPay__block -->
            <?php endif; ?>
                
            </div>
          </section><!-- /shopPay -->
        </main>
        </div>
    <?php get_footer(); ?>