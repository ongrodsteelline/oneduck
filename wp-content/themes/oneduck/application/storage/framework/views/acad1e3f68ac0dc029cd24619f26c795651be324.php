<?php $__env->startSection('content'); ?>
    <main class="main main__pd main_table max">
        <section class="basket">
            <h1>Корзина</h1>
            <cart v-bind:is-auth="<?php echo e(json_encode($isAuth)); ?>" checkout-url="<?php echo e(wc_get_checkout_url()); ?>"></cart>
        </section>
    </main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/wp-content/themes/oneduck/application/resources/views/cart/index.blade.php ENDPATH**/ ?>