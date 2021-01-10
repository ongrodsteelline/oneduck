<?php $__env->startSection('content'); ?>
    <main class="main">
        <section class="profile">
            <h1>Профиль</h1>
            <profile v-bind:user='<?php echo json_encode($user, 15, 512) ?>'></profile>
        </section>
    </main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/wp-content/themes/oneduck/application/resources/views/profile/index.blade.php ENDPATH**/ ?>