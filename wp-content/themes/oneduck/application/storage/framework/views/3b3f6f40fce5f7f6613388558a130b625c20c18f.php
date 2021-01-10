<div class="sidebar__menu js-sidebar__menu">
    <ul>
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li data-menu="menu_<?php echo e($category->term_id); ?>" class="js-sidebar__menu__li">
                <a href="<?php echo e(get_term_link($category)); ?>" class="arrow">
                    <?php echo e($category->name); ?>

                    <?php if($category->has_children): ?>
                        <i class="ic-arrow_right"></i>
                    <?php endif; ?>
                </a>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div><?php /**PATH /var/www/wp-content/themes/oneduck/application/resources/views/parts/sidebar/category-list.blade.php ENDPATH**/ ?>