<ul>
    <?php $__currentLoopData = $children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li>
            <a href="<?php echo e(get_term_link($child)); ?>">
                <?php echo e($child->name); ?>

            </a>
            <?php if($child->has_children): ?>
                <?php echo $__env->make('parts.sidebar.submenu.ul', ['children' => $child->children], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul><?php /**PATH /var/www/wp-content/themes/oneduck/application/resources/views/parts/sidebar/submenu/ul.blade.php ENDPATH**/ ?>