(function ($) {
    function submitFormWithAjax(btn_or_form, callback) {

        if ($(btn_or_form).prop('tagName') == 'loginform') {
            $form = $(btn_or_form)
        } else {
            $form = $(btn_or_form).closest('form')
        }

        data = $form.serialize()
        action = $form.attr('action')

        $.post(action, data, callback)

    }

    $('#loginform').submit(function (e) {

        e.preventDefault()
        e.stopPropagation()

        submitFormWithAjax(this, function (html) {
            let login = $('#user_login').val()
            let error = $(html).find('#login_error').text()
            let success = $(html).find('.message').text()
            var modal_wrap = $('.js-modal__dialog')
            if (error == '') {
                modal_wrap.addClass('aut')
                setTimeout(function () {
                    window.location.reload()
                }, 3000)
            } else {
                $('.error-input').html(error)
            }
            // if (error == 'Неизвестное имя пользователя. Перепроверьте или попробуйте ваш адрес email.') {
            //   $('#email-field').addClass('error');
            // }
            //  else if (error) {
            console.log(error)
            // 	$('.error-message').append(error);
            // }
            // location.reload();
        })

    })
})(jQuery)

jQuery('#register-button').on('click', function (e) {
    e.preventDefault()
    var newUserName = jQuery('#new-username').val()
    // var newUserEmail = jQuery('#new-useremail').val();
    var newUserPassword = jQuery('#new-userpassword').val()
    var first_name = jQuery('#firstName').val()
    var last_name = jQuery('#lastName').val()
    var nameur = jQuery('#nameur').val()
    var phone = jQuery('#phone').val()
    var adress = jQuery('#adress').val()
    var ynp = jQuery('#ynp').val()
    var iban = jQuery('#iban').val()
    var modal_wrap = jQuery('.js-modal__dialog')

    jQuery.ajax({
        type: 'POST',
        url: '/wp-admin/admin-ajax.php',
        data: {
            action: 'register_user_front_end',
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
                    wrap = input.closest('.js-form__cod')
                jQuery('#errorCode').hide()
                jQuery('.errorHide').show()

                if (input.val().length == 1) {
                    wrap.find('.current').removeClass('current')
                    wrap.find('.form__cod__two').addClass('current')
                } else if (input.val().length == 2) {
                    wrap.find('.current').removeClass('current')
                    wrap.find('.form__cod__three').addClass('current')
                } else if (input.val().length == 3) {
                    wrap.find('.current').removeClass('current')
                    wrap.find('.form__cod__four').addClass('current')
                } else if (input.val().length == 4 && Number(input.val()) == results) {
                    wrap.find('.current').removeClass('current')
                    modal_wrap.addClass('reg_stop show')
                    modal_wrap.removeClass('step')
                    jQuery('.js-btn__modal__close').click(function () {
                        location.reload()
                    })
                } else if (input.val().length == 4 && Number(input.val()) != results) {
                    jQuery('#errorCode').show()
                    jQuery('.errorHide').hide()
                }
            })
        },
        error: function (results) {

        }
    })
})

document.addEventListener('product-gallery-mounted', () => {
    $('.slider-single').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: false,
        adaptiveHeight: true,
        infinite: false,
        useTransform: true,
        speed: 400,
        cssEase: 'cubic-bezier(0.77, 0, 0.18, 1)',
    })

    $('.slider-nav').on('init', function (event, slick) {
        $('.slider-nav .slick-slide.slick-current').addClass('is-active')
    }).slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        dots: false,
        focusOnSelect: false,
        infinite: false,
        responsive: [
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    dots: true
                }
            }
        ]
    })

    $('.slider-single').on('afterChange', function (event, slick, currentSlide) {
        $('.slider-nav').slick('slickGoTo', currentSlide)
        var currrentNavSlideElem = '.slider-nav .slick-slide[data-slick-index="' + currentSlide + '"]'
        $('.slider-nav .slick-slide.is-active').removeClass('is-active')
        $(currrentNavSlideElem).addClass('is-active')
    })

    $('.slider-nav').on('click', '.slick-slide', function (event) {
        event.preventDefault()
        var goToSingleSlide = $(this).data('slick-index')

        $('.slider-single').slick('slickGoTo', goToSingleSlide)
    })

    //open slider full screen

    $(document).on('click', '.js-nf__tovar__slider-inner', function () {
        var fix_open = $(this)
        wrap = fix_open.closest('.js-nf__tovar__slider')

        if (!$('.js-nf__tovar__slider').hasClass('open')) {
            wrap.addClass('open')
            $('.slider-single').slick('slickSetOption', {
                arrows: true,
                speed: 1000,
            }, true)
        }

    })

    //close slider full screen

    $(document).on('click', '.js-nf__close', function () {

        var fix_close = $(this)
        wrap = fix_close.closest('.open').removeClass('open')

        $('.slider-single').slick('slickSetOption', {
            arrows: false,
            speed: 400
        }, true)
    })
})

//sidebar menu

if ($(window).width() < 992) {
    $(document).on('click', '.js-nf__btnMenu', function () {
        var btn = $(this)
        wrap_btn = btn.closest('.js-nf__btnMenu-wrap').addClass('open')

        //new2
        wrap_btn = btn.closest('.nf__subMenu').addClass('over');
    })
} else {
    $(document).on('mouseleave', '.js-subMenu', function () {
        $('.js-nf__btnMenu-wrap').removeClass("open");
        $('.js-nf__btnMenu-wrap').find('ul').slideUp(300);
        document.querySelector(".js-wrapper").style.height = "auto";
    });

    var wrapheight = $('.js-wrapper').innerHeight();
    $(document).on('click', '.js-nf__btnMenu', function () {
        var btn = $(this)
        wrap_btn = btn.closest('.js-nf__btnMenu-wrap').toggleClass('open')
        li_wrap = btn.closest('.js-sidebar__menu__li').offset().top;

        if (wrap_btn.hasClass('open')) {
            wrap_btn.find('ul').first().slideDown(300)
        } else {
            wrap_btn.find('ul').first().slideUp(300)
        }

        setTimeout(function () {
            subMenu = btn.closest('.js-subMenu').innerHeight();
            summ = subMenu + li_wrap;

            
            if (summ > wrapheight){
                raznost = summ - wrapheight;
                itog = raznost + wrapheight + 100;

                document.querySelector(".js-wrapper").style.height = itog + "px";
            } else {

                document.querySelector(".js-wrapper").style.height = "auto";
            }

        }, 300);

        $(document).on('click', function (e) {
            if (!$(e.target).closest('.js-nf__btnMenu-wrap').length) {
                $('.js-nf__btnMenu-wrap').removeClass('open')
                $('.js-nf__btnMenu-wrap').find('ul').slideUp(300)
            }
            e.stopPropagation()
        })
        
        $(document).on('click', function (e) {
            if (!$(e.target).closest(".js-nf__btnMenu-wrap").length) {

                document.querySelector(".js-wrapper").style.height = "auto";

            }
            e.stopPropagation();
        });
    })


}

$(document).on('click', '.js-sidebar__menu__li>span', function () {
    var btn = $(this)
    li_btn = btn.closest('ul').find('.js-sidebar__menu__li').removeClass('open')

    if (btn.closest('.js-sidebar__menu__li').hasClass('open')) {
        btn.closest('.js-sidebar__menu__li').removeClass('open')
        
        //new
        $('.sidebar').removeClass("over")
    } else {
        btn.closest('.js-sidebar__menu__li').addClass('open')
        
        //new
        $('.sidebar').addClass("over")
    }
    $(document).on('click', function (e) {
        if (!$(e.target).closest('.js-sidebar__menu__li').length) {
            $('.js-sidebar__menu__li').removeClass('open')
            $('.js-nf__btnMenu-wrap').removeClass('open')

            //new
            $('.sidebar').removeClass("over");
            //new2
            $('.js-subMenu').removeClass("over");
        }
        e.stopPropagation()
    })

})

//sidebar btn_back

$(document).on('click', '.js-nf__subMenu__back', function () {
    var back__btn = $(this)
    wrap_arrow = back__btn.closest('.js-sidebar__menu__li').removeClass('open')

    //new
    $('.sidebar').removeClass("over");
})
$(document).on('click', '.js-nf__subMenu__back2', function () {
    var back__btn = $(this)
    wrap_arrow = back__btn.closest('.js-nf__btnMenu-wrap').removeClass('open')

    //new2
    $('.js-subMenu').removeClass("over");
})
$(document).on('click', '.js-nf__subMenu__back3', function () {
    var back__btn = $(this)
    wrap_arrow = back__btn.closest('.js-nf__btnMenu-wrap').removeClass('open')
})

//sidebar choice category

$(document).on('click', '.js-nf__sidebar__btn', function () {
    var btn = $(this)
    wrap_btn = btn.closest('.js-sidebar__menu')

    if (wrap_btn.hasClass('category')) {
        wrap_btn.find('.js-sidebar__menu-category').slideDown(700)
        $('.nf__sidebar__wood > ul').css('height', '0')
        wrap_btn.removeClass('category')
    } else {
        wrap_btn.find('.js-sidebar__menu-category').slideUp(700)
        setTimeout(function () {
            $('.nf__sidebar__wood > ul').css('height', 'auto')
        }, 700)
        wrap_btn.addClass('category')
    }
})

//pravki main.js

var wrap_sidebar = $('.js-wrapper')
document.querySelector('.js-burger').addEventListener('click', function () {
    document.querySelector('.js-wrapper').classList.toggle('sideOpen')
    if (document.querySelector('.js-wrapper').classList.contains('sideOpen')) {
        document.body.classList.add('over')
    } else {
        document.body.classList.remove('over')
    }
})

$(document).on('click', '.js-nf__main', function () {
    if ($('body').hasClass('over')) {
        $('.js-wrapper').removeClass('sideOpen')
        $('body').removeClass('over')
    }
})

$('.js-checkbox').change(function () {
    if ($('.js-checkbox').is(':checked')) {
        wrap_sidebar.addClass('min')
        $('.js-wrapper').addClass('min_cont')

        $('.js-sidebar')
            .mouseenter(function () {
                setTimeout(function () {
                    $('.js-wrapper').addClass('min_cont')
                }, 200)
            })
            .mouseleave(function () {
                setTimeout(function () {
                    $('.js-wrapper').removeClass('min_cont')
                }, 200)
            })
    } else {
        wrap_sidebar.removeClass('min')
        $('.js-wrapper').removeClass('min_cont')
    }
})
