<?php
/**
 * Template Name: About
 */

get_header();
?>

<main class="main">
    <section class="about">
        <h1><?php the_title(); ?></h1>
        <div class="about__img">
            <img src="<?php the_field('about_bg'); ?>" alt="about">
            <div><?php the_field('about_desc'); ?></div>
        </div>
        <div class="about__info">
            <div class="about__info__left">
                <?php the_field('about_editor'); ?>
            </div>
            <div class="about__info__right">
                <?php $num1 = get_field('about_num1'); if ($num1) : ?>
                    <div><?= $num1; ?> <span><?php the_field('about_text1'); ?></span></div>
                <?php endif; ?>
                <?php $num2 = get_field('about_num2'); if ($num2) : ?>
                    <div><?= $num2; ?> <span><?php the_field('about_text2'); ?></span></div>
                <?php endif; ?>
                <?php $num3 = get_field('about_num3'); if ($num3) : ?>
                    <div><?= $num3; ?> <span><?php the_field('about_text3'); ?></span></div>
                <?php endif; ?>
                <?php $num4 = get_field('about_num4'); if ($num4) : ?>
                    <div><?= $num4; ?> <span><?php the_field('about_text4'); ?></span></div>
                <?php endif; ?>
            </div>
        </div>
    </section><!-- /about -->
</main>
<?php get_footer(); ?>