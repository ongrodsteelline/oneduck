(function ($) {
    function submitFormWithAjax(btn_or_form, callback) {

        if ($(btn_or_form).prop("tagName") == "loginform") {
            $form = $(btn_or_form);
        } else {
            $form = $(btn_or_form).closest("form");
        }

        data = $form.serialize();
        action = $form.attr("action");

        $.post(action, data, callback);

    }

    $("#loginform").submit(function (e) {

        e.preventDefault();
        e.stopPropagation();

        submitFormWithAjax(this, function (html) {
            let login = $('#user_login').val();
            let error = $(html).find('#login_error').text();
            let success = $(html).find('.message').text();
            var modal_wrap = $(".js-modal__dialog");
            if (error == '') {
                modal_wrap.addClass("aut");
                setTimeout(function () {
                    window.location.reload();
                }, 3000);
            } else {
                $('.error-input').html(error);
            }
            // if (error == 'Неизвестное имя пользователя. Перепроверьте или попробуйте ваш адрес email.') {
            //   $('#email-field').addClass('error');
            // }
            //  else if (error) {
            console.log(error);
            // 	$('.error-message').append(error);
            // }
            // location.reload();
        });

    });
})(jQuery);

jQuery('#register-button').on('click', function (e) {
    e.preventDefault();
    var newUserName = jQuery('#new-username').val();
    // var newUserEmail = jQuery('#new-useremail').val();
    var newUserPassword = jQuery('#new-userpassword').val();
    var first_name = jQuery('#firstName').val();
    var last_name = jQuery('#lastName').val();
    var nameur = jQuery('#nameur').val();
    var phone = jQuery('#phone').val();
    var adress = jQuery('#adress').val();
    var ynp = jQuery('#ynp').val();
    var iban = jQuery('#iban').val();
    var modal_wrap = jQuery(".js-modal__dialog");

    jQuery.ajax({
        type: "POST",
        url: "<?php echo admin_url('admin-ajax.php'); ?>",
        data: {
            action: "register_user_front_end",
            new_user_name: newUserName,
            first_name: first_name,
            last_name: last_name,
            new_user_password: newUserPassword,
            nameur: nameur,
            phone: phone,
            adress: adress,
            ynp: ynp,
            iban: iban
        },
        success: function (results) {
            // console.log(results);
            jQuery('.js-validate__cod').on('keyup', function () {
                var input = jQuery(this),
                    wrap = input.closest(".js-form__cod");
                jQuery('#errorCode').hide();
                jQuery('.errorHide').show();

                if (input.val().length == 1) {
                    wrap.find('.current').removeClass('current');
                    wrap.find('.form__cod__two').addClass('current');
                } else if (input.val().length == 2) {
                    wrap.find('.current').removeClass('current');
                    wrap.find('.form__cod__three').addClass('current');
                } else if (input.val().length == 3) {
                    wrap.find('.current').removeClass('current');
                    wrap.find('.form__cod__four').addClass('current');
                } else if (input.val().length == 4 && Number(input.val()) == results) {
                    wrap.find('.current').removeClass('current');
                    modal_wrap.addClass("reg_stop show");
                    modal_wrap.removeClass("step");
                    jQuery('.js-btn__modal__close').click(function () {
                        location.reload();
                    });
                } else if (input.val().length == 4 && Number(input.val()) != results) {
                    jQuery('#errorCode').show();
                    jQuery('.errorHide').hide();
                }
            });
        },
        error: function (results) {

        }
    });
});