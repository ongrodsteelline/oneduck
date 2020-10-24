<?php
/**
 * Template Name: Profile
 */

global $user_ID;
 
if( !$user_ID ) {
	header('location:' . site_url() . '/');
	exit;
} else {
	$userdata = get_user_by( 'id', $user_ID );
}
$current_user = wp_get_current_user();

get_header();
?>
<main class="main">
    <section class="profile">
        <h1><?php the_title(); ?></h1>
            <div class="profile__inner">
                <div class="profile__logo">
                            ОХ
                    <span>Gold</span>
                        </div>
                        <form action="<?php echo get_stylesheet_directory_uri() ?>/includes/profile-update.php" class="form js-form__profile" method="POST">
                            <div class="form__title">
                                <p>Добрый день, <span><?= ''.$current_user->user_firstname.' '.$current_user->user_lastname .'';?></span></p>
                                <p>В этом разделе вы можете изменить или дополнить информацию о своем профиле.</p>
                            </div>
                            <div class="form__block">
                                <div class="form__group form__group_fl form__group_inp">
                                    <label for="">Юр. ЛИЦО? <span class="js-info" data-toggle="tooltip" data-placement="left" title="Вы можете заказать товар только в количестве, кратном указанном"></span></label>
                                    <div class="switch-wrap form__switch form__switch_mg">
                                        <label class="switch" id="switch">
                                            <input type="checkbox" class="">
                                            <span class="switch__btn"></span>
                                        </label>
                                    </div><!-- /switch-wrap -->
                                </div>
                                <div class="form__group form__group_inp">
                                    <label for="nameur">Название Юр. Лица</label>
                                    <div class="form__group__field">
                                        <input type="text" name="nameur" id="nameUR" value="<?php echo get_user_meta($user_ID, 'nameur', true ) ?>" />
                                    </div>
                                </div>
                            </div><!-- /form__block -->
                            <div class="form__block">
                                <div class="form__group form__group_inp">
                                    <label for="last_name">Фамилия</label>
                                    <div class="form__group__field js-form__group__field">
                                        <input type="text" class="js-validate" name="last_name" placeholder="Фамилия" value="<?php echo $userdata->last_name ?>" />

                                        <div>
                                            <p>Это поле не может быть пустым</p><button class="js-btn__correct">OK</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form__group form__group_inp">
                                    <label for="first_name">Имя</label>
                                    <div class="form__group__field js-form__group__field">
                                        <input type="text" name="first_name" placeholder="Имя" class="js-validate" value="<?php echo $userdata->first_name ?>" />
                                        <div>
                                            <p>Это поле не может быть пустым</p><button class="js-btn__correct">OK</button>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /form__block -->
                            <div class="form__block">
                                <div class="form__group form__group_inp">
                                    <label for="email">Еmail</label>
                                    <div class="form__group__field js-form__group__field">
                                        <input type="email" name="login" placeholder="Email" class="js-validate" value="<?php echo $userdata->user_login ?>" />
                                        <div>
                                            <p>Это поле не может быть пустым</p><button class="js-btn__correct">OK</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form__group form__group_inp">
                                    <label for="phone">Телефон</label>
                                    <div class="form__group__field js-form__group__field">
                                        <input type="text" name="phone" class="js-validate" placeholder="Телефон" value="<?php echo get_user_meta($user_ID, 'phone', true ) ?>" />
                                        <div>
                                            <p>Это поле не может быть пустым</p><button class="js-btn__correct">OK</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form__group form__group_inp">
                                    <label for="adress">Адрес</label>
                                    <div class="form__group__field js-form__group__field">
                                        <input type="text" class="js-validate" name="adress" placeholder="Адрес" value="<?php echo get_user_meta($user_ID, 'adress', true ) ?>" />
                                        <div>
                                            <p>Это поле не может быть пустым</p><button class="js-btn__correct">OK</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form__group form__group_inp">
                                    <label for="ynp">УНП</label>
                                    <div class="form__group__field">
                                        <input type="text" name="ynp" 
                                        placeholder="необязательно" value="<?php echo get_user_meta($user_ID, 'ynp', true ) ?>" />

                                    </div>
                                </div>
                                <div class="form__group form__group_inp">
                                    <label for="iban">IBAN</label>
                                    <div class="form__group__field">
                                        <input type="text" name="iban" placeholder="необязательно" value="<?php echo get_user_meta($user_ID, 'iban', true ) ?>" />

                                    </div>
                                </div>
                            </div><!-- /form__block -->
                            <div class="form__block form__block_password js-form__block_password">
                                <div class="form__group form__group_fl form__group_inp">
                                    <label for="">Сменить пароль?</label>
                                    <div class="switch-wrap form__switch form__switch_mg">
                                        <label class="switch">
                                            <input type="checkbox" class="js-checkbox__password">
                                            <span class="switch__btn"></span>
                                        </label>
                                    </div><!-- /switch-wrap -->
                                </div>
                                <div class="form__group form__group_inp form__group_password">
                                    <label for="pwd2">Новый пароль</label>
                                    <div class="form__group__field js-form__group__field">
                                        <input type="password" class="js-validate" name="pwd2" />
                                        <div>
                                            <p>Это поле не может быть пустым</p><button class="js-btn__correct">OK</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form__group form__group_inp form__group_password">
                                    <label for="pwd3">Повторите пароль</label>
                                    <div class="form__group__field js-form__group__field">
                                        <input type="password" class="js-validate" name="pwd3"  />

                                        <div>
                                            <p>Это поле не может быть пустым</p><button class="js-btn__correct">OK</button>
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" class="form__btn form__btn_pad js-btn__step_val js-btn__profile" value="СОХРАНИТЬ">
                            </div><!-- /form__block -->
                        </form>
                    </div>
                </section><!-- /profile -->
            </main>
            <script>
                var switchButton = jQuery('#switch');
                var nameUrInput = jQuery('#nameUR').val();
                switchButton.removeClass('swchecked');
                if (nameUrInput != '') {
                    switchButton.click();
                    console.log(nameUrInput);
                }
            </script>
<?php get_footer(); ?>