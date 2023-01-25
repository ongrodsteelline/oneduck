jQuery(document).ready(function ($) {
    function attribute_row_indexes() {
        $('.product_attributes .woocommerce_attribute').each(function (index, el) {
            $('.attribute_position', el).val(parseInt($(el).index('.product_attributes .woocommerce_attribute'), 10));
        });
    }

    $('.product_attributes').off('click').on('click', '.remove_row', function () {
        if (window.confirm(woocommerce_admin_meta_boxes.remove_attribute)) {
            var $parent = $(this).parent().parent();

            if ($parent.is('.taxonomy')) {
                $parent.find('select, input[type=text], input[type=checkbox]').val('');
                $parent.hide();
                $('select.attribute_taxonomy').find('option[value="' + $parent.data('taxonomy') + '"]').removeAttr('disabled');
            } else {
                $parent.find('select, input[type=text], input[type=checkbox]').val('');
                $parent.hide();
                attribute_row_indexes();
            }
        }
        return false;
    });
});