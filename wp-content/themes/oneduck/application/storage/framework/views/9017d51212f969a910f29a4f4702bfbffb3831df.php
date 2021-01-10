<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="breadcrumb-item breadcrumb__item <?php echo e($item['active'] ? 'active' : null); ?>">
                <?php if($item['active']): ?>
                    <span><?php echo e($item['name']); ?></span>
                <?php else: ?>
                    <a href="<?php echo e($item['url']); ?>"><?php echo e($item['name']); ?></a>
                <?php endif; ?>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ol>
</nav><?php /**PATH /var/www/wp-content/themes/oneduck/application/resources/views/parts/breadcrumbs.blade.php ENDPATH**/ ?>