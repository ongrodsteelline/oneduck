<?php
/**
 * Template Name: Contacts
 */

get_header();
?>
    <main class="main">
                <section class="contacts">
                    <h1><?php the_title(); ?></h1>

                    <?php $map = get_field('map'); if ($map) : ?>
                        <div id="map"><?= $map; ?></div>
                    <?php endif; ?>

                    <?php if( have_rows('content') ): ?>
                    <?php while( have_rows('content') ): the_row(); ?>
                    <div class="contacts__block">
                    <?php if (get_row_layout() == 'adress_block') : ?>
                        <?php if (get_sub_field('adress_title')) {  ?>
                        <h2><?php the_sub_field('adress_title'); ?></h2>
                        <?php } ?>
                    <?php endif; ?>
                    <?php if (get_row_layout() == 'adress_block') : ?>
                        <?php if (get_sub_field('adress')) {  ?>
                        <div>
                            <h4>Адрес</h4>
                            <p><?php the_sub_field('adress'); ?></p>
                        </div>
                        <?php } ?>
                    <?php endif; ?>
                    <?php if (get_row_layout() == 'adress_block') : ?>
                        <?php if (get_sub_field('adress_email')) {  ?>
                        <div>
                            <h4>Email</h4>
                            <a href="mailto:<?php the_sub_field('adress_email'); ?>"><?php the_sub_field('adress_email'); ?></a>
                        </div>
                        <?php } ?>
                    <?php endif; ?>
                    <?php if (get_row_layout() == 'adress_block') : ?>
                        <?php if (get_sub_field('phone1') || get_sub_field('phone2') || get_sub_field('phone3')) {  ?>
                        <div>
                            <h4>ТЕЛЕФОНЫ</h4>
                            <a href="tel:<?php the_sub_field('phone1'); ?>" class="tel"><?php the_sub_field('phone1'); ?></a>
                            <a href="tel:<?php the_sub_field('phone2'); ?>" class="tel"><?php the_sub_field('phone2'); ?></a>
                            <a href="tel:<?php the_sub_field('phone3'); ?>" class="tel"><?php the_sub_field('phone3'); ?></a>
                        </div>
                        <?php } ?>
                    <?php endif; ?>
                    <?php if (get_row_layout() == 'adress_block') : ?>
                        <div>
                        <?php if (get_sub_field('social_telegram') || get_sub_field('social_vk')) {  ?>
                            <h4>Мессенджеры и Сети</h4>
                            <?php if (get_sub_field('social_telegram')) {  ?>
                            <div>Telegram: <a href="<?php the_sub_field('social_telegram'); ?>" target="_blank"><?php the_sub_field('social_telegram'); ?></a></div>
                            <?php  } ?>
                            <?php if (get_sub_field('social_vk')) {  ?>
                            <div>Vk: <a href="<?php the_sub_field('social_vk'); ?>" target="_blank"><?php the_sub_field('social_vk'); ?></a></div>
                            <?php  } ?>
                        </div>
                        <?php } ?>
                    <?php endif; ?>
                    </div><!-- /contacts__block -->
                    <?php endwhile; ?>
                <?php endif; ?>
                    
                </section><!-- /contacts -->
            </main>

<?php get_footer(); ?>