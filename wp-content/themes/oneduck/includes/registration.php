<?php

function my_registration_form()
{ ?>
    <form action="#" method="POST" name="register-form" class="form js-form__aut register-form">
        <fieldset>
            <div class="form__block">
                <div class="form__group form__group_fl form__group_inp">
                    <label for="">Юр. ЛИЦО?
                        <span class="js-info" data-toggle="tooltip" data-placement="left"
                              title="Вы можете заказать товар только в количестве, кратном указанном"></span>
                    </label>
                    <div class="switch-wrap form__switch form__switch_mg">
                        <label class="switch">
                            <input type="checkbox" name="isLegal" class="">
                            <span class="switch__btn"></span>
                        </label>
                    </div><!-- /switch-wrap -->
                </div>
                <div class="form__group form__group_inp">
                    <label for="nameur">Название Юр. Лица</label>
                    <div class="form__group__field">
                        <input type="text" name="legalEntity">
                    </div>
                </div>
            </div><!-- /form__block -->
            <div class="form__block">
                <div class="form__group form__group_inp">
                    <label for="last_name">Фамилия</label>
                    <div class="form__group__field js-form__group__field">
                        <input type="text" name="lastname" id="lastName" class="js-validate">
                        <div><p>Это поле не может быть пустым</p><span class="button js-btn__correct">OK</span></div>
                    </div>
                </div>
                <div class="form__group form__group_inp">
                    <label for="first_name">Имя</label>
                    <div class="form__group__field js-form__group__field">
                        <input type="text" name="firstname" id="firstName" class="js-validate">
                        <div><p>Это поле не может быть пустым</p><span class="button js-btn__correct">OK</span></div>
                    </div>
                </div>
            </div><!-- /form__block -->
            <div class="form__block">
                <div class="form__group form__group_inp">
                    <label for="new_user_name">Еmail</label>
                    <div class="form__group__field js-form__group__field">
                        <input type="email" name="email" id="new-username" class="js-validate">
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
                        <input type="text" name="address" id="adress" class="js-validate">
                        <div><p>Это поле не может быть пустым</p><span class="button js-btn__correct">OK</span></div>
                    </div>
                </div>
                <div class="form__group form__group_inp">
                    <label for="ynp">УНП</label>
                    <div class="form__group__field">
                        <input type="text" name="taxId" id="ynp" class="js-validate" placeholder="необязательно">
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
                <input type="submit" class="button form__btn form__btn_pad js-btn__step_val" id="register-button"
                       value="Зарегистрироваться">
            </div><!-- /form__block -->
        </fieldset>
    </form>
    <?php
}

add_action('wp_ajax_register_user_front_end', 'register_user_front_end', 0);
add_action('wp_ajax_nopriv_register_user_front_end', 'register_user_front_end');

function register_user_front_end()
{
    $email = stripcslashes($_POST['email']);
    $firstname = stripcslashes($_POST['firstname']);
    $lastname = stripcslashes($_POST['lastname']);
    $new_user_password = $_POST['new_user_password'];
    $user_data = array(
        'user_login' => $email,
        'firstname' => $firstname,
        'last_name' => $lastname,
        'user_pass' => $new_user_password,
        'role' => 'subscriber'
    );
    $user_id = wp_insert_user($user_data);
    if (!is_wp_error($user_id)) {
        update_user_meta($user_id, 'profile_legal_entity', $_POST['legalEntity']);
        update_user_meta($user_id, 'profile_phone', $_POST['phone']);
        update_user_meta($user_id, 'profile_address', $_POST['address']);
        update_user_meta($user_id, 'profile_tax_id', $_POST['taxId']);
        update_user_meta($user_id, 'profile_iban', $_POST['iban']);

        // Почта сервера и админа должна совпадать!
        $rand = rand(0000, 9999);
        $subject = 'Код верификации на сайте OneDuck';
        $message = 'Здравствуйте, '.$firstname.'! Ваш код верификации: '.$rand.'';
        wp_mail($email, $subject, $message);
        echo $rand;

    } else {
        if (isset($user_id->errors['empty_user_email'])) {
            $notice_key = 'User Name and Email are mandatory';
            echo $notice_key;
        } elseif (isset($user_id->errors['existing_user_emal'])) {
            echo 'User name already exixts.';
        } else {
            echo 'Error Occured please fill up the sign up form carefully.';
        }
    }
    die;
}