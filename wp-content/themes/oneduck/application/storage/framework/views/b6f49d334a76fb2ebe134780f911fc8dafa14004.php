<?php
    {{
        /* @var $product \App\Modules\Woocommerce\Models\Product */
    }}
?>
<tr class="js-tr__wrap">
    <td class="table__img" data-toggle="modal" data-target="#Modal__img">
        <div>
            <img src="<?php echo e($product->image['url']); ?>" alt="">
            <span class="js-info info_error" data-toggle="tooltip" data-placement="right"
                  title="Проверьте кратность"></span>
            <span class="js-info info_success" data-toggle="tooltip" data-placement="right"
                  title="Успешно добавлено"></span>
        </div>
    </td>
    <td class="table__name">
        <?php echo e($product->name); ?>

        <p><span>Бренд:</span> <?php echo e($product->brand->name); ?></p>
        <div>
            <div>Бренд:
                <p><?php echo e($product->brand->name); ?></p>
            </div>
            <div>Арт.:
                <p><?php echo e($product->sku); ?></p>
            </div>
            <div>Кратность:
                <p></p>
            </div>
            <div>Ед. изм.: <p><?php echo e($product->unit); ?></p></div>
            <div class="table__scale <?php echo e($product->getStockClass()); ?>">
                Наличие:
                <div></div>
            </div>
        </div>
    </td>
    <td class="table__article"><?php echo e($product->sku); ?></td>
    <td class="table__brend"><?php echo e($product->brand->name); ?></td>
    <td class="table__multiplicity js-multiplicity"></td>
    <td class="table__izmer"><?php echo e($product->unit); ?></td>
    <td class="table__scale <?php echo e($product->getStockClass()); ?>">
        <div></div>
    </td>
    <td class="table__PPC"><?php echo e($product->rrp); ?></td>
    <td class="table__cena">
        <span><?php echo e($product->regularPrice); ?></span>
    </td>
    <td class="table__basket">
        <span>0 р.</span>
        <div class="stepper stepper--style-1 js-spinner">
            <input autofocus type="number" min="0" step="1" value="0"
                   class="stepper__input js-stepper__input">
            <div class="stepper__controls">
                <button type="button" spinner-button="up">+</button>
                <button type="button" spinner-button="down">−</button>
            </div>
        </div>
    </td>
    <td class="table__mob js-table__mob show">
        <table>
            <tr>
                <td><span>Артикул:</span>
                    <p><?php echo e($product->sku); ?></p></td>
                <td><span>Кратность:</span>
                    <p></p></td>
                <td><span>Ед.изм:</span>
                    <p><?php echo e($product->unit); ?></p></td>
                <td><span>РРЦ:</span>
                    <p><?php echo e($product->rrp); ?></p></td>
                <td class="table__scale <?php echo e($product->getStockClass()); ?>">
                    <span>Наличие:</span>
                    <div></div>
                </td>
            </tr>
        </table>
        <span class="js-scroll__hands"><i class="ic-hands"></i></span>
    </td>
</tr><?php /**PATH /var/www/wp-content/themes/oneduck/application/resources/views/catalog/item.blade.php ENDPATH**/ ?>