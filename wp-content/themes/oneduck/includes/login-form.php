<?php

function my_login_form() { ?>
<style>
  .error-input {
    color: red;
    font-size: 14px;
    margin-top: 15px;
  }
</style>
<form name="loginform" class="form form_fl js-form__reg" id="loginform" action="<?php home_url(); ?>/wp-login.php" method="post">
              <div class="form__left">
                <div class="form__group">
                  <div class="form__group__field form__group__field_max js-form__group__field">
                    <input type="text" name="log" id="user_login" class="js-validate" placeholder="info@samtehmir.ru">
                    <div><p>Это поле не может быть пустым</p><button class="js-btn__correct">OK</button></div>
                  </div>
                </div>
                <div class="form__group">
                  <div class="form__group__field form__group__field_max js-form__group__field">
                    <input type="password" name="pwd" id="user_pass" class="js-validate" placeholder="password">
                    <div><p>Это поле не может быть пустым</p><button class="js-btn__correct">OK</button></div>
                  </div>
                </div>
                <div class="switch-wrap form__switch">
                  <label class="switch">
                    <input type="checkbox" class="">
                    <span class="switch__btn"></span>
                    <span class="switch__text">Запомнить меня</span>
                  </label>
                </div><!-- /switch-wrap -->
                <input style="margin:0;" type="submit" name="wp-submit" id="wp-submit" class="form__btn js-btn__reg" value="Войти">
                <div class="error-input"></div>
              </div>
              <div class="form__right">
                <div>
                  <span class="sp_reg"></span>
                  <div>
                    <p>Еще нет аккаунта?</p>
                    <p>Перейти к <a href="#" class="js-btn__modal__reg">регистрации</a></p>
                  </div>
                </div>
                <div>
                  <span class="sp_pass"></span>
                  <div>
                    <p>Забыли пароль?</p>
                    <p>Перейти к <a href="#">восстановлению</a></p>
                  </div>
                </div>
              </div>
</form>

<script>
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
          if(error == '') {
                modal_wrap.addClass("aut");
                setTimeout(function() {window.location.reload();}, 3000);
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
</script>


<?php }