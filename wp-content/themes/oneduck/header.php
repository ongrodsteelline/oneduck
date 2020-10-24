<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package oneduck
 */
global $user_ID;

$userdata = get_user_by( 'id', $user_ID );
$current_user = wp_get_current_user();
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <!-- Required meta tags -->
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php bloginfo('name'); wp_title(); ?></title>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
  <style>
    #errorCode {
      display: none;
    }
  </style>
  <div class="wrapper js-wrapper">

    <div class="sidebar js-sidebar">
      <div class="sidebar__top">
          <div class="sidebar__top__logo">
              <a href="/"></a>
          </div>
          <div class="sidebar__menu js-sidebar__menu">
              <ul style="opacity: 0.2;">
                  <li data-menu="menu_1" class="js-sidebar__menu__li">
                      <a href="/catalog" class="arrow">Абразивные материалы <i class="ic-arrow_right"></i></a>
                  </li>

                  <li><a href="/catalog">Вентиляционные системы</a></li>
                  <li data-menu="menu_2" class="js-sidebar__menu__li">
                      <a href="/catalog" class="arrow">Водосливная арматура <i class="ic-arrow_right"></i></a>
                  </li>
                  <li><a href="/catalog">Канализационные системы</a></li>
                  <li data-menu="menu_1" class="js-sidebar__menu__li">
                      <a href="/catalog" class="arrow">Радиаторы и комплектующие <i class="ic-arrow_right"></i></a>
                  </li>
                  <li data-menu="menu_1" class="js-sidebar__menu__li">
                      <a href="/catalog" class="arrow">Водонагреватели <i class="ic-arrow_right"></i></a>
                  </li>
                  <li><a href="/catalog">Насосное оборудование</a></li>
                  <li data-menu="menu_1" class="js-sidebar__menu__li">
                      <a href="/catalog" class="arrow">Заполная арматура <i class="ic-arrow_right"></i></a>
                  </li>
                  <li data-menu="menu_2" class="js-sidebar__menu__li">
                      <a href="/catalog" class="arrow">Фитинги резьбовые <i class="ic-arrow_right"></i></a>
                  </li>
                  <li data-menu="menu_1" class="js-sidebar__menu__li">
                      <a href="/catalog" class="arrow">Уплотнительные материалы <i class="ic-arrow_right"></i></a>
                  </li>
                  <li data-menu="menu_1" class="js-sidebar__menu__li">
                      <a href="/catalog" class="arrow">Смесители <i class="ic-arrow_right"></i></a>
                  </li>
                  <li data-menu="menu_2" class="js-sidebar__menu__li">
                      <a href="/catalog" class="arrow">Фаянс, крепеж <i class="ic-arrow_right"></i></a>
                  </li>
                  <li><a href="/catalog">Хозтовары</a></li>
              </ul>
          </div>
      </div>
      <div class="sidebar__bot">
          <a href="/about"><i class="ic-message"></i>
              <p>О компании</p>
          </a>
          <a href="/shop-pay"><i class="ic-package"></i>
              <p>Доставка и оплата</p>
          </a>
          <a href="/stock"><i class="ic-radio"></i>
              <p>Акции</p>
          </a>
          <a href="#"><i class="ic-book"></i>
              <p>Новости</p>
          </a>
          <a href="/contacts"><i class="ic-map"></i>
              <p>Контакты</p>
          </a>
          <div class="sidebar__bot__switch switch-wrap">
              <label class="switch">
                  <input type="checkbox" class="js-checkbox">
                  <span class="switch__btn"></span>
                  <span class="switch__text">Свернуть панель</span>
              </label>
          </div><!-- /switch-wrap -->
      </div>
  </div><!-- /sidebar -->

  <ul class="sidebar__menu__subMenu subMenu js-subMenu" data-menu="menu_1">
      <li class="subMenu__akzii"><a href="#">
              <img src="<?php bloginfo('template_url'); ?>/app/assets/img/sidebar/subMenu/fire.png" alt="">
              <span>В марте скидка <br>на все абразивные материалы 30%</span>
          </a></li>
      <li class="subMenu__title"><a href="#">Радиаторы:</a></li>
      <li><a href="#">Мансардные</a></li>
      <li><a href="#">Свободностоящие</a></li>
      <li><a href="#">Монтируемые</a></li>
      <li class="subMenu__title"><a href="#">Комплектующие:</a></li>
      <li>
          <a>Сетки <i class="ic-arrow_right_subMenu js-btn__arrow"></i></a>
          <ul>
              <li><a href="#">Силиконовые воронки</a></li>
              <li>
                  <a href="#">Акриловые воронки</a>
                  <ul>
                      <li><a href="#">Акрил N100</a></li>
                      <li><a href="#">Акрил N200</a></li>
                  </ul>
              </li>
          </ul>
      </li>
      <li>
          <a>Воронки <i class="ic-arrow_right_subMenu js-btn__arrow"></i></a>
          <ul>
              <li><a href="#">Силиконовые воронки</a></li>
              <li>
                  <a href="#">Акриловые воронки</a>
                  <ul>
                      <li><a href="#">Акрил N100</a></li>
                      <li><a href="#">Акрил N200</a></li>
                  </ul>
              </li>
          </ul>
      </li>
      <li><a href="#">Фильтры</a></li>
  </ul><!-- /subMenu -->
  <ul class="sidebar__menu__subMenu subMenu js-subMenu" data-menu="menu_2">
      <li class="subMenu__akzii"><a href="#">
              <img src="<?php bloginfo('template_url'); ?>/app/assets/img/sidebar/subMenu/fire.png" alt="">
              <span>В марте скидка <br>на все абразивные материалы 30%</span>
          </a></li>
      <li class="subMenu__title"><a href="#">Радиаторы:</a></li>
      <li><a href="#">Мансардные</a></li>
      <li><a href="#">Свободностоящие</a></li>
      <li><a href="#">Монтируемые</a></li>
      <li class="subMenu__title"><a href="#">Комплектующие:</a></li>
      <li>
          <a>Сетки <i class="ic-arrow_right_subMenu js-btn__arrow"></i></a>
          <ul>
              <li><a href="#">Силиконовые воронки</a></li>
              <li>
                  <a href="#">Акриловые воронки</a>
                  <ul>
                      <li><a href="#">Акрил N100</a></li>
                      <li><a href="#">Акрил N200</a></li>
                  </ul>
              </li>
          </ul>
      </li>
      <li>
          <a>Воронки <i class="ic-arrow_right_subMenu js-btn__arrow"></i></a>
          <ul>
              <li><a href="#">Силиконовые воронки</a></li>
              <li>
                  <a href="#">Акриловые воронки</a>
                  <ul>
                      <li><a href="#">Акрил N100</a></li>
                      <li><a href="#">Акрил N200</a></li>
                  </ul>
              </li>
          </ul>
      </li>
      <li><a href="#">Фильтры</a></li>
  </ul><!-- /subMenu -->

    <div class="wrapper-content">
      <header class="header">
        <span class="js-burger"><i></i></span>
        <div style="opacity:.2;" class="input__wrap js-input__wrap">
          <span class="js-poisk"></span>
          <input type="text" placeholder="Поиск по товарам...">
        </div>

        <div class="dropdown dropdown__header dropdown__header_tel">
          <a class="btn btn-secondary drop__btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ic-phone"></i><p>+375 (29) <span>5064707</span></p> <i class="ic-arrow_down"></i>
          </a>
        
          <div class="dropdown-menu dropdown__header__menu" aria-labelledby="dropdownMenuLink">
          <?php $header_phone1 = get_field('header_phone1', 'option'); if ($header_phone1) : ?>
            <a class="dropdown-item drop__item" href="tel:<?= $header_phone1; ?>"><?= $header_phone1; ?></a>
          <?php endif; ?>
          <?php $header_phone2 = get_field('header_phone2', 'option'); if ($header_phone2) : ?>
            <a class="dropdown-item drop__item" href="tel:<?= $header_phone2; ?>"><?= $header_phone2; ?></a>
          <?php endif; ?>
          <?php $header_phone3 = get_field('header_phone3', 'option'); if ($header_phone3) : ?>
            <a class="dropdown-item drop__item" href="tel:<?= $header_phone3; ?>"><?= $header_phone3; ?></a>
          <?php endif; ?>
          <?php $header_adress = get_field('header_adress', 'option'); if($header_adress) : ?>
            <a class="dropdown-item drop__item" href="#"><i class="ic-map__header"></i> <?= $header_adress; ?></a>
          <?php endif; ?>
          <?php $header_email = get_field('header_email', 'option'); if($header_email) : ?>
            <a class="dropdown-item drop__item drop__item_mail" href="mailto:<?= $header_email; ?>"><i class="ic-mail__header"></i><span><?= $header_email; ?></span></a>
          <?php endif; ?>
          </div>
        </div>

        <div class="header__logo__mob">
          <img src="<?php bloginfo('template_url'); ?>/app/assets/img/sidebar/logo_min.png" alt="">
        </div>
        <?php if(!is_user_logged_in()) : ?>
        <a href="#" class="vhod" data-toggle="modal" data-target="#Modal"><i class="ic-user"></i><p>Вход <span>/</span> Регистрация</p></a>
        <?php endif; ?>
      <?php if(is_user_logged_in()) : ?>
        <div class="dropdown dropdown__header dropdown__header_autor">
          <a class="btn btn-secondary drop__btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ic-user_check"></i> <p><?= ''.$current_user->user_firstname.' '.$current_user->user_lastname .'';?></p> <i class="ic-arrow_down"></i>
          </a>
          <div class="dropdown-menu dropdown__header__menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item drop__item" href="/profile">Профиль</a>
            <a class="dropdown-item drop__item" href="/history">Заказы</a>
            <a class="dropdown-item drop__item drop__item_color" href="<?= wp_logout_url('/'); ?>">Выйти</a>
          </div>
        </div>
      <?php endif; ?>
        <a href="/basket" style="opacity: 0.2;" class="shopping"><i class="ic-shopping"></i><p>2445.32 BYN / <span>22 тов.</span></p><span class="shopping__col">42</span></a>
        
      </header><!-- /header -->

    <!-- Modal -->
    <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal__dialog js-modal__dialog" role="document">
        <div class="modal-content modal__content">
          <div class="modal-header modal__content__header">
            <h5 class="modal-title" id="exampleModalLabel">Авторизация</h5>
            <span data-dismiss="modal"></span>
          </div>
          <div class="modal-body modal__content__body">
            <?php my_login_form(); ?>
          </div>
          <!-- <div class="modal-footer modal__content__footer">
            <p>Этот аккаунт пока не активирован.</p>
            <p>Обратитесь по телефону <a href="tel: +375 (29) 5034521">+375 (29) 5034521</a> если прошло более суток после регистрации.</p>
          </div> -->
        </div>
        <div class="modal-content modal__content modal__content_finish">
          <div class="modal-header modal__content__header">
            <h5 class="modal-title" id="exampleModalLabel">Авторизация</h5>
            <span data-dismiss="modal"></span>
          </div>
          <div class="modal-body modal__content__body">
            <form action="" class="form form_al">
              <img src="<?php bloginfo('template_url'); ?>/app/assets/img/modal/finish.png" alt="">
              <h2>Успешная авторизация</h2>
              <p>Перезагружаем страницу...</p>
              <div class="form__download">
                <div class="form__download__state"></div>
              </div>
            </form>
          </div>
        </div>
        <div class="modal-content modal__content modal__content_reg">
          <div class="modal-header modal__content__header">
            <h5 class="modal-title" id="exampleModalLabel">Регистрация</h5>
            <span data-dismiss="modal" class="js-btn__modal__close"></span>
          </div>
          <div class="modal-body modal__content__body">
            <?php my_registration_form(); ?> 
          </div>
        </div>
        <div class="modal-content modal__content modal__content_step">
          <div class="modal-header modal__content__header">
            <span data-dismiss="modal" class="js-btn__modal__close"></span>
          </div>
          <div class="modal-body modal__content__body">
            <form action="" class="form form_al">
              <img src="<?php bloginfo('template_url'); ?>/app/assets/img/modal/process.png" alt="">
              <h2 class="errorHide">Почти готово...</h2>
              <h2 id="errorCode">Код введён неверно! <br> Попробуйте ещё раз.</h2>
              <p class="errorHide">На ваш e-mail отправлен проверочный код.</p>
              <p class="errorHide">Пожалуйста, введите его здесь.</p>
              <div class="form__cod js-form__cod">
                <input type="text"  maxlength="4" class="js-validate__cod">
                <span class="form__cod__one current"></span>
                <span class="form__cod__two"></span>
                <span class="form__cod__three"></span>
                <span class="form__cod__four"></span>
              </div>
            </form>
          </div>
        </div>
        <div class="modal-content modal__content modal__content_finish2">
          <div class="modal-header modal__content__header">
            <span data-dismiss="modal" class="js-btn__modal__close"></span>
          </div>
          <div class="modal-body modal__content__body">
            <form action="" class="form form_al">
              <img src="<?php bloginfo('template_url'); ?>/app/assets/img/modal/finish.png" alt="">
              <h2>Регистрация завершена</h2>
              <p class="p_mg">На платформе предусмотрена <span>ручная активация</span> аккаунтов.</p>
              <p>Обычно это происходит в течении нескольких часов.</p>
              <p>После активации аккаунта вы получите соответствующее уведомление
                на ваш электронный адрес.</p>
            </form>
          </div>
        </div>
      </div>
    </div>
