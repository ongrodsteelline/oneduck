<?php $__env->startSection('content'); ?>
    <main class="main">
        <?php if($isOrderReceived): ?>
            <?php echo $__env->make('checkout.order-received', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php else: ?>
            <checkout v-bind:is-auth="<?php echo e(json_encode($isAuth)); ?>" customer-address="<?php echo e($address); ?>"></checkout>
        <?php endif; ?>
    </main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/wp-content/themes/oneduck/application/resources/views/checkout/index.blade.php ENDPATH**/ ?>