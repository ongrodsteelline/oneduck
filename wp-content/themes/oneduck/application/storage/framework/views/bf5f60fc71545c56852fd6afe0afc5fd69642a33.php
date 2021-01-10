<?php $__env->startSection('content'); ?>
    <main class="main main__pd main_table">
        <section class="catalog">
            <h1><?php echo e($title); ?></h1>
            <?php if($breadcrumbs): ?>
                <?php echo $__env->make('parts.breadcrumbs', ['breadcrumbs' => $breadcrumbs], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
            <?php if($isCrawler): ?>
                <div class="switch-wrap form__switch">
                    <label class="switch">
                        <input type="checkbox" class="js-dop_table">
                        <span class="switch__btn"></span>
                        <span class="switch__text">Показать доп. характеристики</span>
                    </label>
                </div>

                <table class="table">
                    <thead>
                    <tr>
                        <th class="table__img">Фото</th>
                        <th class="table__name">Название</th>
                        <th class="table__article">Артикул</th>
                        <th class="table__brend">Бренд <span><i class="ic-filter_up"></i><i class="ic-filter_down"></i></span>
                        </th>
                        <th class="table__multiplicity">Кратность
                            <i class="ic-info js-info" data-toggle="tooltip" data-placement="left"
                               title="Вы можете заказать товар только в количестве, кратном указанном"></i>
                        </th>
                        <th class="table__izmer">Ед. изм.</th>
                        <th class="table__scale">Наличие <span><i class="ic-filter_up"></i><i
                                        class="ic-filter_down"></i></span></th>
                        <th class="table__PPC">РРЦ, <span>руб</span></th>
                        <th class="table__cena">Цена, <span>руб</span> <span><i class="ic-filter_up"></i><i
                                        class="ic-filter_down"></i></span></th>
                        <th class="table__basket">В корзину</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('catalog.item', ['product' => $product], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>

                <nav aria-label="Page navigation example" class="pagination__wrap">
                    <?php echo $__env->make('parts.pagination', ['pagination' => $pagination], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </nav>
            <?php else: ?>
                <router-view type="<?php echo e($type); ?>" :category-id="<?php echo e($categoryId); ?>" :limit="<?php echo e($limit); ?>" :products='<?php echo json_encode($products, 15, 512) ?>' :pages='<?php echo json_encode($pagination, 15, 512) ?>'></router-view>
            <?php endif; ?>

            <?php if($description): ?>
                <p>
                    <?php echo $description; ?>

                </p>
            <?php endif; ?>
        </section>

        <?php echo $__env->make('catalog.filter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </main>
    <div style="opacity: 0.2;" class="preload__wrap">
        <div class="preload-juggle">
            <div class="ball"></div>
            <div class="ball"></div>
            <div class="ball"></div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/wp-content/themes/oneduck/application/resources/views/catalog/index.blade.php ENDPATH**/ ?>