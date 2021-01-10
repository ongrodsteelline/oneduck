<?php
/* @var $product \App\Modules\Woocommerce\Models\Product */
?>


<?php $__env->startSection('content'); ?>
    <main class="main">
        <section class="tovar__wrap">
            <h1><?php echo e($product->name); ?></h1>
            <?php if($breadcrumbs): ?>
                <?php echo $__env->make('parts.breadcrumbs', ['breadcrumbs' => $breadcrumbs], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

            <?php if($isCrawler): ?>
                <div class="tovar js-tr__wrap">
                    <div class="tovar__slider">
                        <div class="tovar__slider__bigfoto js-tovar__slider__bigfoto" data-toggle="modal"
                             data-target="#Modal__img">
                            <img src="<?php echo e($product->image['url']); ?>" alt="">
                            <span class="js-info info_error" data-toggle="tooltip" data-placement="right"
                                  title="Проверьте кратность"></span>
                            <span class="js-info info_success" data-toggle="tooltip" data-placement="right"
                                  title="Успешно добавлено"></span>
                        </div>

                        <div class="tovar__slider__mini">
                            <div class="swiper-container sl__mini js-sl__mini">
                                <div class="swiper-wrapper">
                                    <?php $__currentLoopData = $product->gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="swiper-slide sl__mini__slide">
                                            <img src="<?php echo e($image['url']); ?>" alt="">
                                            <span class="js-info info_error" data-toggle="tooltip"
                                                  data-placement="right"
                                                  title="Проверьте кратность"></span>
                                            <span class="js-info info_success" data-toggle="tooltip"
                                                  data-placement="right"
                                                  title="Успешно добавлено"></span>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="tovar__content">
                        <div class="tovar__content__top">
                            <div>
                                <p>Артикул</p>
                                <p><?php echo e($product->sku); ?></p>
                            </div>
                            <div>
                                <p>Бренд</p>
                                <p><?php echo e($product->brand->name); ?></p>
                            </div>
                            <div>
                                <p>Кратность <i class="ic-info js-info" data-toggle="tooltip" data-placement="left"
                                                title=""
                                                data-original-title="Вы можете заказать товар только в количестве, кратном указанном"
                                                aria-describedby="tooltip645723"></i></p>
                                <p><?php echo e(implode(' / ', $product->multiplicity)); ?></p>
                            </div>
                            <div>
                                <p>Ед. изм.</p>
                                <p><?php echo e($product->unit); ?></p>
                            </div>
                            <div>
                                <p>Наличие</p>
                                <div class="table__scale <?php echo e($product->getStockClass()); ?>">
                                    <div></div>
                                </div>
                            </div>
                        </div>
                        <div class="tovar__content__bot">
                            <div class="tovar__content__bot__head">
                                <p>
                                <span>РЦ, <span>руб</span>
                                    <i class="ic-info js-info"
                                       data-toggle="tooltip"
                                       data-placement="left"
                                       title=""
                                       data-original-title="Вы можете заказать товар только в количестве, кратном указанном"
                                    ></i>
                                </span>
                                    <span><?php echo e($product->rrp); ?></span>
                                </p>
                                <div>
                                    <p><span class="sp_color">Цена, <span>руб</span></span></p>
                                    <p><?php echo e($product->regularPrice); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php echo $__env->make('popup.gallery', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php else: ?>
                <product-single v-bind:product='<?php echo json_encode($product, 15, 512) ?>'></product-single>
            <?php endif; ?>
        </section>
    </main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/wp-content/themes/oneduck/application/resources/views/product/index.blade.php ENDPATH**/ ?>