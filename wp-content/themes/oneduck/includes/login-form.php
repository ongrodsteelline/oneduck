<?php

function my_login_form()
{ ?>
    <form name="loginform" class="form form_fl js-form__reg" id="loginform" action="<?php home_url(); ?>/wp-login.php"
          method="post">
        <div class="form__left">
            <div class="form__group">
                <div class="form__group__field form__group__field_max js-form__group__field">
                    <input type="text" name="log" id="user_login" class="js-validate" placeholder="Email">
                    <div><p>Это поле не может быть пустым</p>
                        <button class="js-btn__correct">OK</button>
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group__field form__group__field_max js-form__group__field">
                    <input type="password" name="pwd" id="user_pass" class="js-validate" placeholder="Пароль">
                    <div><p>Это поле не может быть пустым</p>
                        <button class="js-btn__correct">OK</button>
                    </div>
                </div>
            </div>
            <div class="switch-wrap form__switch">
                <label class="switch">
                    <input type="checkbox" class="">
                    <span class="switch__btn"></span>
                    <span class="switch__text">Запомнить меня</span>
                </label>
            </div><!-- /switch-wrap -->
            <input style="margin:0;" type="submit" name="wp-submit" id="wp-submit" class="form__btn js-btn__reg"
                   value="Войти">
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
<?php }