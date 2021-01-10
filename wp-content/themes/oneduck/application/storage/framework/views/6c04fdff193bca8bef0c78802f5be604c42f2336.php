<?php if($pagination): ?>
    <ul class="pagination"><span>Страница:</span>
        <?php $__currentLoopData = $pagination; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="page-item pagination__item <?php echo e(($page['isCurrent']) ? 'active' : null); ?>">
                <a class="page-link pagination__link" href="<?php echo e($page['url']); ?>"><?php echo e($page['num']); ?></a>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
<?php endif; ?><?php /**PATH /var/www/wp-content/themes/oneduck/application/resources/views/parts/pagination.blade.php ENDPATH**/ ?>