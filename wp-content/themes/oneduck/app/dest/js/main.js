jQuery(document).ready(function () {
    
    // subMenu
    jQuery('.js-btn__arrow').click(function(){
        var arrow = jQuery(this);
            wrap_arrow = arrow.closest('li').toggleClass('open');
            
            if (wrap_arrow.hasClass('open')){
                wrap_arrow.find('ul').first().slideDown(100);
            } else{
                wrap_arrow.find('ul').first().slideUp(100);
            }
            
        jQuery(document).on('click', function(e) {
            if (!jQuery(e.target).closest(".js-btn__arrow").length) {
              jQuery('.js-btn__arrow').closest('li').removeClass("open");
            }
            e.stopPropagation();
        });
    })
    // end subMenu

    // poisk
    jQuery('.js-poisk').click(function(){
        if (jQuery(window).width() < 992){
        var wrap_poisk = jQuery('.js-input__wrap');

        wrap_poisk.addClass('open');
        jQuery(document).on('click', function(e) {
            if (!jQuery(e.target).closest(".js-input__wrap").length) {
            jQuery('.js-input__wrap').removeClass("open");
            }
            e.stopPropagation();
        });
        };
    })
    // end poisk

    // sidebar
    var wrap_sidebar = jQuery(".js-wrapper");
    jQuery('.js-burger').click(function(){
        jQuery('.js-wrapper').toggleClass('sideOpen');
        if (jQuery('.js-wrapper').hasClass('sideOpen')){
            jQuery('body').addClass('over');
        } else{
            jQuery('body').removeClass('over');
        }
    })
    
    jQuery(".js-checkbox").change(function() {     
        if (jQuery(".js-checkbox").is(":checked")) {  
            wrap_sidebar.addClass('min');
            jQuery('.js-wrapper').addClass('min_cont');
            jQuery(".js-sidebar")
            .mouseenter(function() {
                jQuery('.js-wrapper').addClass('min_cont');
            })
            .mouseleave(function(){                 
                jQuery('.js-wrapper').removeClass('min_cont');
            });
        } else{
            wrap_sidebar.removeClass('min');
            jQuery('.js-wrapper').removeClass('min_cont');
        }
    });
    jQuery(window).on('resize', function(){
        if (jQuery(window).width() < 992){
            wrap_sidebar.removeClass('min');
            jQuery(".js-checkbox").removeAttr("checked");
        } else{
            jQuery('.js-wrapper').removeClass('sideOpen');
            jQuery('.js-input__wrap').removeClass("open");
        }
    });
    // end sidebar

    jQuery(".js-dop_table").change(function() {  
        var table_parent = jQuery('.table__wrap');   
        if (jQuery(".js-dop_table").is(":checked")) {  
            table_parent.addClass('dop');
        } else{
            table_parent.removeClass('dop');
        }
    });

    // validate input
    function validate(input){
        if (input.val().length < 1 && input.is(':visible')){
            input.closest('.js-form__group__field').addClass('error');
        } else {
            input.closest('.js-form__group__field').removeClass('error');
        }
    };
    

    jQuery('.js-btn__correct').click(function(){
        jQuery(this).closest('.js-form__group__field').removeClass('error');
    });
    // end validate input

    (function(jQuery){

        var 
        btn_modal = jQuery(".js-btn__reg"),
        btn_modal_reg = jQuery(".js-btn__modal__reg"),
        btn_step_val = jQuery(".js-btn__step_val"),
        btn_profile = jQuery(".js-btn__profile"),
        btn_close = jQuery(".js-btn__modal__close"),
        form_profile = jQuery(".js-form__profile"),
        modal_wrap = jQuery(".js-modal__dialog");
        
        btn_modal.click(function() {
            
            jQuery('.js-form__reg input').each(function(){
                validate(jQuery(this));
            });
        });

        btn_modal_reg.click(function() {
            modal_wrap.addClass("reg show");
            modal_wrap.removeClass("aut");
        });
        btn_step_val.click(function() {
            jQuery('.js-form__aut input').each(function(){
                validate(jQuery(this));
            });
            if(!jQuery('.js-form__aut .js-form__group__field.error').length){            
                modal_wrap.addClass("step show");
                modal_wrap.removeClass("reg");
            }
        });
        btn_profile.click(function() {
            jQuery('.js-form__profile input').each(function(){
                validate(jQuery(this));
                form_profile.addClass("no_ok");
                form_profile.removeClass("ok");
            });
            if(!jQuery('.js-form__profile .js-form__group__field.error').length){            
                form_profile.addClass("ok");
                form_profile.removeClass("no_ok");
            }
        });

        btn_close.click(function() {
            modal_wrap.removeClass("reg");
            modal_wrap.removeClass("aut");
            modal_wrap.removeClass("step");
            modal_wrap.removeClass("reg_stop");
            setTimeout(function() {modal_wrap.removeClass("show");}, 1000);
        });

        jQuery('#Modal').on('hidden.bs.modal', function (e) {
            modal_wrap.removeClass("reg");
            modal_wrap.removeClass("aut");
            modal_wrap.removeClass("step");
            modal_wrap.removeClass("reg_stop");
            modal_wrap.removeClass("show");
        });


        // vvod koda
        // jQuery('.js-validate__cod').on('keyup', function(){
        //     var input = jQuery(this),
        //     wrap = input.closest(".js-form__cod");

        //     if (input.val().length == 1){
        //         wrap.find('.current').removeClass('current');
        //         wrap.find('.form__cod__two').addClass('current');
        //     }else if (input.val().length == 2){
        //         wrap.find('.current').removeClass('current');
        //         wrap.find('.form__cod__three').addClass('current');
        //     }else if (input.val().length == 3){
        //         wrap.find('.current').removeClass('current');
        //         wrap.find('.form__cod__four').addClass('current');
        //     }else if (input.val().length == 4){
        //         wrap.find('.current').removeClass('current');
        //         modal_wrap.addClass("reg_stop show");
        //         modal_wrap.removeClass("step");
        //     }
        // });
        // end vvod koda
    })(jQuery);

    // filter

    jQuery('.js-more').click(function(){
        var btn_more = jQuery(this),
        wrap = btn_more.closest('.js-param');

        wrap.addClass('open');

    });

    jQuery('.js-show_check').click(function(){
        var btn_show = jQuery(this),
        wrap = btn_show.closest('.js-param'),
        item = wrap.find('.js-input_box');
        // item_checked = wrap.find('.js-input_box:checked').length;

        wrap.toggleClass('active');
        if (item.is(':checked') && wrap.hasClass('active')){
            item.each(function () {
                var item = jQuery(this);
                if (item.is(':checked')){
                    item.closest('.param__check').removeAttr('style');
                } else{
                    item.closest('.param__check').hide();
                }
            });
            btn_show.html('показать ещё ' + wrap.find('.param__check:hidden').length);
        } else{
            item.closest('.param__check').removeAttr('style');
            btn_show.html('свернуть не выбранное');
        }
        if (!wrap.hasClass('active')){
            item.closest('.param__check').removeAttr('style');
        }

    });
    // end filter

    jQuery(window).scroll(function() {
        if (jQuery(window).scrollTop() > 67){
            jQuery('.js-main__filter__wrap').addClass('scroll');
        } else{
            jQuery('.js-main__filter__wrap').removeClass('scroll');
        }
    });

    jQuery('.js-filter_btn').click(function(){
        jQuery('.js-main__filter__wrap').toggleClass('hide');
        jQuery('.js-filter_btn').toggleClass('hide');
    });

    // validate table__multiplicity

    function multiplicity(index){
        var result;
        var tr_wrap = index.closest('.js-tr__wrap'),
            i = tr_wrap.find('.js-multiplicity').html().split('/')[0];

            result = index.val()%i;
            if (result == 0){
                tr_wrap.addClass('success').removeClass('error');
            } else{
                tr_wrap.addClass('error').removeClass('success');
            }
    }

    jQuery(".js-stepper__input").on('change keyup', function () {
        var inp_col = jQuery(this),
        tr_wrap = inp_col.closest('.js-tr__wrap');
        multiplicity(inp_col);
        if (inp_col.val() == '' || inp_col.val() == '0'){
            tr_wrap.removeClass('error success');
        }
        recalc();
      });

    // end validate table__multiplicity

    
    // zoom
    if (jQuery("#panzoom").length) {
        const elem = document.getElementById('panzoom')
        const zoomInButton = document.getElementById('zoom-in')
        const zoomOutButton = document.getElementById('zoom-out')
        const resetButton = document.getElementById('reset')
        const rangeInput = document.getElementById('range-input')
        const panzoom = Panzoom(elem, {
        maxScale: 5
        })
        zoomInButton.addEventListener('click', panzoom.zoomIn)
        zoomOutButton.addEventListener('click', panzoom.zoomOut)
        resetButton.addEventListener('click', panzoom.reset)
        rangeInput.addEventListener('input', (event) => {
        panzoom.zoom(event.target.valueAsNumber)
        })
        elem.parentElement.addEventListener('wheel', panzoom.zoomWithWheel)
    }
    // end zoom


    
    //slider mini
    if (jQuery(".js-sl__mini").length) {

        var swiper = new Swiper(".js-sl__mini", {
            slideToClickedSlide: true,
            slidesPerView: 'auto',
            spaceBetween: 16,
            loop: true,
            breakpoints: {
                460: {
                    slidesPerView: 3,
                }
            },
            slideVisibleClass: 'slide-visible',
            loopFillGroupWithBlank: true,
        });

        swiper.on('slideChangeTransitionEnd', function () {
            var currentImg = jQuery(".sl__mini__slide.swiper-slide-active").html(),
                currentImgLg = jQuery(".js-tovar__slider__bigfoto");

            currentImgLg.html(currentImg);
            // tooltip
            jQuery('.js-info').tooltip();
            // end tooltip
        });

    }
    //end mini slider

    // table del
    jQuery('.js-table__del').click(function(){
        var del = jQuery(this),
        wrap = del.closest('.js-tr__wrap'),
        caption = wrap.attr('data-caption');



        wrap.addClass("effectFadeOutLeft");
        wrap.delay(500).fadeOut("slow",function(){
            jQuery(this).remove();
            recalc();
        });

        if (jQuery('.js-tr__wrap[data-caption='+ caption +']').length == 1){
            jQuery('tr[data-caption='+ caption +']').remove();
        }
        
    });
    // end table del

    // tooltip
    jQuery('.js-info').tooltip();
    // end tooltip

    // preloader
    jQuery('.js-param__check').click(function(){
        jQuery('.js-wrapper').addClass('loaded_hiding');
      window.setTimeout(function () {
        jQuery('.js-wrapper').removeClass('loaded_hiding');
      }, 2000);
    });
    // end preloader


    jQuery('.js-table__mob').on('scroll', function() {
        var table = jQuery(this),
            scrol_table = Math.round(table.scrollLeft());
        var maxScroll = table.find('table').width() - table.width();
        if (scrol_table < maxScroll){
            table.addClass('show');
        } else{
            table.removeClass('show');
        }
    });


    // password
    var wrap_profile = jQuery('.js-form__block_password');

    jQuery(".js-checkbox__password").change(function() {    
        if (jQuery(".js-checkbox__password").is(":checked")) {  
            wrap_profile.addClass('show');
        } else{
            wrap_profile.removeClass('show');
            wrap_field.removeClass('js-form__group__field');
        }
    });
    // end password


    // edit adress

    var wrap = jQuery('.js-order__info');

    jQuery('.js-btn__adress').click(function(){
        wrap.addClass('edit');
    });

    jQuery('.js-btn__adress_new').click(function(){  
        jQuery('.js-adress__field').text(jQuery(".js-inp__vvod__adress").val());
        wrap.removeClass('edit');
    });


    var wrap_adress = jQuery('.js-order__info__delivery');

    jQuery(".js-checkbox__adress").change(function() {    
        if (jQuery(".js-checkbox__adress").is(":checked")) {  
            wrap_adress.addClass('show');
        } else{
            wrap_adress.removeClass('show');
        }
    });
    // end edit adress


    if (jQuery(".js-param").length) {
        jQuery(".js-param").each(function(){
            var col_wrap = jQuery(this),
            col = col_wrap.find('.param__check:hidden').length;

            col_wrap.find('.js-not_visible').html(col);
        })

    }

    

    // symma
    function recalc() {
        var first = true,
        totalsum = 0,
        totalsum_num = 0;

        jQuery(".js-tr__wrap").each(function(){
            var col_wrap = jQuery(this),
            caption = col_wrap.data('caption'),
            product_sum = Number(col_wrap.find('.js-cena').html()),
            product_num = Number(col_wrap.find('.js-stepper__input').val()),
            summ = Number((product_sum * product_num).toFixed(2)),
            totalsum_num = Number(jQuery('tr[data-caption='+ caption +']').find('.symma').html());
            if (first){
                first = false;
                totalsum = 0,
                totalsum_num = 0;
            }
            totalsum = totalsum_num + summ;

            jQuery('tr[data-caption='+ caption +']').find('.symma').html(totalsum.toFixed(2));
            

            console.log(summ);
            console.log(totalsum);
            console.log(totalsum_num);

        })
    }
    recalc();

    // end symma


    jQuery(".js-stepper__input").on('change keyup', function (){
        var container = jQuery('#shopping');
        container.addClass('add');

        setTimeout(function() {
            container.removeClass('add');
         }, 1000)
    });


    jQuery('#clear_btn').on('click', function(){
        var r = confirm("Очистить?");
        if (r == true){
          window.location.reload();
        }
    });



    // jQuery(".js-check__pay").change(function() {  
    //     var pay = jQuery(this),
    //         pay_parent = pay.closest('.js-switch-pay');

    //         if (pay.is(":checked")) {  
    //             pay_parent.addClass('active');
    //         }

    //     jQuery('.js-switch-pay').each(function(){

    //         var pay_parent = jQuery(this),
    //         pay = pay_parent.find('.js-check__pay');

    //         if (pay_parent.hasClass('active')) {  
    //             jQuery('.js-switch-pay').removeClass('active');
    //             jQuery(".js-check__pay").removeAttr("checked");
    //             pay_parent.addClass('active');
    //             pay.attr("checked","checked");
    //         } else{

    //         }
    //     });

    // });




    jQuery(".js-sidebar__menu__li")
    .mouseenter(function() {
        var data = jQuery(this).attr('data-menu');
        jQuery(".js-subMenu[data-menu='" + data + "']").addClass('show');

    })
    .mouseleave(function(){                 
        var data = jQuery(this).attr('data-menu');
        jQuery(".js-subMenu[data-menu='" + data + "']").removeClass('show');
    });

});


jQuery(function(){
    jQuery('#nameur').attr('disabled','disabled');
    jQuery('.switch__btn').on('click', function(){
        jQuery(this).toggleClass('swchecked');
        jQuery('#nameur').removeAttr('disabled');
        if (!jQuery('.switch__btn.swchecked')) {
            jQuery('#nameur').attr('disabled','disabled');
        }
    });
});