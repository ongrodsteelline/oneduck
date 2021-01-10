<ul class="sidebar__menu__subMenu subMenu js-subMenu" data-menu="<?php echo e($target); ?>">
    <?php if($flash->enabled): ?>
        <li class="subMenu__akzii">
            <a href="<?php echo e($flash->link); ?>">
                <img src="<?php echo e(asset('static/img/sidebar/subMenu/fire.png')); ?>" alt="">
                <span><?php echo $flash->text; ?></span>
            </a>
        </li>
    <?php endif; ?>
    <?php $__currentLoopData = $children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="subMenu__title">
            <a href="<?php echo e(get_term_link($category)); ?>"><?php echo e($category->name); ?></a>
        </li>
        <?php $__currentLoopData = $category->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <a href="<?php echo e(get_term_link($child)); ?>">
                    <?php echo e($child->name); ?>

                    <?php if($child->has_children): ?>
                        <i class="ic-arrow_right_subMenu js-btn__arrow"></i>
                    <?php endif; ?>
                </a>
                <?php echo $__env->make('parts.sidebar.submenu.ul', ['children' => $child->children], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul><?php /**PATH /var/www/wp-content/themes/oneduck/application/resources/views/parts/sidebar/sub-menu.blade.php ENDPATH**/ ?>