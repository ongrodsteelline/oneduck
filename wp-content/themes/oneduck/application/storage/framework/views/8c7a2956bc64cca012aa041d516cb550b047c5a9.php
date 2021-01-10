<?php $__env->startSection('content'); ?>
    <main class="main">
        <div class="search-result">
            <?php if(!strlen($query)): ?>
                Необходимо указать поисковой запрос
            <?php endif; ?>
            <?php if(count($categories) === 0 && count($products) === 0 && $query): ?>
                Ничего не найдено по запросу "<?php echo e($query); ?>"
            <?php endif; ?>
            <?php if(count($categories)): ?>
                <div class="search-result__row">
                    <div class="search-result__title">Категории:</div>
                    <div class="search-result__list">
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e($category['url']); ?>"><?php echo e($category['name']); ?></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if(count($products)): ?>
                <div class="search-result__row">
                    <div class="search-result__title">Товары:</div>
                    <div class="search-result__list">
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e($product['url']); ?>"><?php echo e($product['name']); ?></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/wp-content/themes/oneduck/application/resources/views/search/index.blade.php ENDPATH**/ ?>