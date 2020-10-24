<?php

function my_registration_form() { ?>
	<form action="#" method="POST" name="register-form" class="form js-form__aut register-form">
		<fieldset> 
              <div class="form__block">
                <div class="form__group form__group_fl form__group_inp">
                  <label for="">Юр. ЛИЦО? <span class="js-info" data-toggle="tooltip" data-placement="left" title="Вы можете заказать товар только в количестве, кратном указанном"></span></label>
                  <div class="switch-wrap form__switch form__switch_mg">
                    <label class="switch">
                      <input type="checkbox" class="">
                      <span class="switch__btn"></span>
                    </label>
                  </div><!-- /switch-wrap -->
                </div>
                <div class="form__group form__group_inp">
                  <label for="nameur">Название Юр. Лица</label>
                  <div class="form__group__field">
                    <input type="text" name="nameur" id="nameur">
                    </div>
                </div>
              </div><!-- /form__block -->
              <div class="form__block">
                <div class="form__group form__group_inp">
                  <label for="last_name">Фамилия</label>
                  <div class="form__group__field js-form__group__field">
                    <input type="text" name="last_name" id="lastName" class="js-validate">
                    <div><p>Это поле не может быть пустым</p><span class="button js-btn__correct">OK</span></div>
                  </div>
                </div>
                <div class="form__group form__group_inp">
                  <label for="first_name">Имя</label>
                  <div class="form__group__field js-form__group__field">
                    <input type="text" name="first_name" id="firstName" class="js-validate">
                    <div><p>Это поле не может быть пустым</p><span class="button js-btn__correct">OK</span></div>
                  </div>
                </div>
              </div><!-- /form__block -->
              <div class="form__block">
                <div class="form__group form__group_inp">
                  <label for="new_user_name">Еmail</label>
                  <div class="form__group__field js-form__group__field">
                    <input type="email" name="new_user_name" id="new-username" class="js-validate">
                    <div><p>Это поле не может быть пустым</p><span class="button js-btn__correct">OK</span></div>
                  </div>
                  </div>
                <div class="form__group form__group_inp">
                  <label for="phone">Телефон</label>
                  <div class="form__group__field js-form__group__field">
                    <input type="text" name="phone" id="phone" class="js-validate">
                    <div><p>Это поле не может быть пустым</p><span class="button js-btn__correct">OK</span></div>
                  </div>
                </div>
                <div class="form__group form__group_inp">
                  <label for="adress">Адрес</label>
                  <div class="form__group__field js-form__group__field">
                    <input type="text" name="adress" id="adress" class="js-validate">
                    <div><p>Это поле не может быть пустым</p><span class="button js-btn__correct">OK</spam></div>
                  </div>
                </div>
                <div class="form__group form__group_inp">
                  <label for="ynp">УНП</label>
                  <div class="form__group__field">
                    <input type="text" name="ynp" id="ynp" class="js-validate" placeholder="необязательно">
                  </div>
                </div>
                <div class="form__group form__group_inp">
                  <label for="iban">IBAN</label>
                  <div class="form__group__field">
                    <input type="text" name="iban" id="iban" class="js-validate" placeholder="необязательно">
                  </div>
                </div>
              </div><!-- /form__block -->
              <div class="form__block">
                <div class="form__group form__group_inp">
                  <label for="new_user_password">Пароль</label>
                  <div class="form__group__field js-form__group__field">
                    <input type="password" name="new_user_password" id="new-userpassword" class="js-validate">
                    <div><p>Это поле не может быть пустым</p><span class="button js-btn__correct">OK</span></div>
                  </div>
                </div>
                <div class="form__group form__group_inp">
                  <label for="re-pwd">Повторите пароль</label>
                  <div class="form__group__field js-form__group__field">
                    <input type="password" name="re-pwd" id="re-pwd" class="js-validate">
                    <div><p>Это поле не может быть пустым</p><span class="button js-btn__correct">OK</span></div>
                  </div>
				</div>
				<input type="submit" class="button form__btn form__btn_pad js-btn__step_val" id="register-button" value="Зарегистрироваться">
			  </div><!-- /form__block -->
			</fieldset>
        </form>
	<script type="text/javascript">
      jQuery('#register-button').on('click',function(e){
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
          type:"POST",
          url:"<?php echo admin_url('admin-ajax.php'); ?>",
          data: {
            action: "register_user_front_end",
            new_user_name : newUserName,
            first_name : first_name,
            last_name : last_name,
            new_user_password : newUserPassword,
            nameur : nameur,
            phone : phone,
            adress : adress,
            ynp : ynp,
            iban : iban
          },
          success: function(results){
            // console.log(results);
            jQuery('.js-validate__cod').on('keyup', function(){
                var input = jQuery(this),
                wrap = input.closest(".js-form__cod");
                jQuery('#errorCode').hide();
                jQuery('.errorHide').show();
                
                if (input.val().length == 1){
                    wrap.find('.current').removeClass('current');
                    wrap.find('.form__cod__two').addClass('current');
                }else if (input.val().length == 2){
                    wrap.find('.current').removeClass('current');
                    wrap.find('.form__cod__three').addClass('current');
                }else if (input.val().length == 3){
                    wrap.find('.current').removeClass('current');
                    wrap.find('.form__cod__four').addClass('current');
                }else if (input.val().length == 4 && Number(input.val()) == results){
                    wrap.find('.current').removeClass('current');
                    modal_wrap.addClass("reg_stop show");
                    modal_wrap.removeClass("step");
                    jQuery('.js-btn__modal__close').click(function(){
                      location.reload();
                    });
                }else if (input.val().length == 4 && Number(input.val()) != results) {
                  jQuery('#errorCode').show();
                  jQuery('.errorHide').hide();
                }
            });
          },
          error: function(results) {

          }
        });
      });
    </script>
 <?php
 }

 add_action('wp_ajax_register_user_front_end', 'register_user_front_end', 0);
 add_action('wp_ajax_nopriv_register_user_front_end', 'register_user_front_end');
 add_action('user_register', 'register_fields');

 function register_user_front_end() {
	   $new_user_name = stripcslashes($_POST['new_user_name']);
	   $first_name = stripcslashes($_POST['first_name']);
	   $last_name = stripcslashes($_POST['last_name']);
	   $new_user_password = $_POST['new_user_password'];
	   $user_nice_name = strtolower($_POST['new_user_email']);
	   $nameur = strtolower($_POST['nameur']);
	   $phone = strtolower($_POST['phone']);
	   $adress = strtolower($_POST['adress']);
	   $adress = strtolower($_POST['ynp']);
	   $iban = strtolower($_POST['iban']);
	   $user_data = array(
		   'user_login' => $new_user_name,
		   'first_name' => $first_name,
		   'last_name' => $last_name,
		   'user_pass' => $new_user_password,
		   'user_nicename' => $user_nice_name,
		   'nameur' => $nameur,
		   'phone' => $phone,
		   'adress' => $adress,
		   'ynp' => $ynp,
		   'iban' => $iban,
		   'role' => 'subscriber'
		   );
	   $user_id = wp_insert_user($user_data);
		   if (!is_wp_error($user_id)) {
          update_user_meta( $user_id, 'nameur', $_POST['nameur'] );
          update_user_meta( $user_id, 'phone', $_POST['phone'] );
          update_user_meta( $user_id, 'adress', $_POST['adress'] );
          update_user_meta( $user_id, 'ynp', $_POST['ynp'] );
          update_user_meta( $user_id, 'iban', $_POST['iban'] );

          // Почта сервера и админа должна совпадать!
          $rand = rand(0000, 9999); 
            $subject = 'Код верификации на сайте OneDuck';
            $message = 'Здравствуйте, '.$first_name.'! Ваш код верификации: '.$rand.'';
            $headers = 'From: <info@wasd.kz>' . "\r\n";
            wp_mail($new_user_name, $subject, $message, $headers,);
             echo $rand;

		   } else {
			 if (isset($user_id->errors['empty_user_email'])) {
			   $notice_key = 'User Name and Email are mandatory';
			   echo $notice_key;
			   } elseif (isset($user_id->errors['existing_user_emal'])) {
			   echo'User name already exixts.';
			   } else {
			   echo'Error Occured please fill up the sign up form carefully.';
			   }
		   }
	 die;
 }