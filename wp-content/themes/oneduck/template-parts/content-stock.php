<main class="main">
          <section class="stock__inner">
            <h1><?php the_title(); ?></h1>
            
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item breadcrumb__item"><a href="/stock">Акции</a></li>
                  <li class="breadcrumb-item breadcrumb__item active" aria-current="page"><span><?php the_title(); ?></span></li>
                </ol>
            </nav>

            <div class="stock__wrap stock__wrap_fl">
                   <?php $view_stock = get_field('view_stock'); ?>
                        <div class="stock__block stock__block_def <?php if($view_stock != 'До') : echo 'stock__block_disabled'; endif; ?>">
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
                <div class="description">
                    <?php the_content(); ?>
                </div>
            </div>
          </section><!-- /stock -->
</main>