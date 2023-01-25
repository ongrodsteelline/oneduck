<?php
/* @var $user User */
?>
        <!doctype html>
<html {{ language_attributes() }}>
<head>
    <!-- Required meta tags -->
    <meta charset="{{ bloginfo('charset') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{ wp_head() }}
</head>
<body {{ body_class() }}>
    <style>
        #errorCode {
            display: none;
        }
    </style>
    <div class="wrapper js-wrapper" id="app">
        <div class="sidebar nf__sidebar js-sidebar">
            <div class="sidebar__top">
                <div class="sidebar__top__logo">
                    <a href="/"></a>
                </div>

                @include('parts.sidebar', ['categories' => $categories])
            </div>

            <div class="sidebar__bot nf__sidebar__bot">
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
                <a href="/contact"><i class="ic-map"></i>
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

        <div class="wrapper-content">
            <header class="header">
                <span class="js-burger"><i></i></span>
                <div class="search_icon">
                    <search></search>
                </div>
                <div class="wrapper_select_warehouses">
                    <select-warehouse :data="{{ json_encode($warehouses) }}"></select-warehouse>
                </div>


                <div class="header__logo__mob">
                    <a href="/"><img src="{{ bloginfo('template_url') }}/app/assets/img/sidebar/logo_min.png" alt=""></a>
                </div>



                <div class="dropdown dropdown__header dropdown__header_tel">
                    <a class="btn btn-secondary drop__btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="ic-phone"></i>
                        <p>+375 (29) <span>5064707</span></p> <i class="ic-arrow_down"></i>
                    </a>

                    <div class="dropdown-menu dropdown__header__menu" aria-labelledby="dropdownMenuLink">

                        <div class="dropdown_text_desc">Контакты:</div>

                        <?php use App\Modules\Wordpress\Models\User;$header_phone1 = get_field('header_phone1', 'option');
                        if ($header_phone1) : ?>
                        <a class="dropdown-item drop__item" href="tel:<?= $header_phone1; ?>"><?= $header_phone1; ?></a>
                        <?php endif; ?>
                        <?php $header_phone2 = get_field('header_phone2', 'option');
                        if ($header_phone2) : ?>
                        <a class="dropdown-item drop__item" href="tel:<?= $header_phone2; ?>"><?= $header_phone2; ?></a>
                        <?php endif; ?>
                        <?php $header_phone3 = get_field('header_phone3', 'option');
                        if ($header_phone3) : ?>
                        <a class="dropdown-item drop__item" href="tel:<?= $header_phone3; ?>"><?= $header_phone3; ?></a>
                        <?php endif; ?>
                        <?php $header_adress = get_field('header_adress', 'option');
                        if ($header_adress) : ?>
                        <a class="dropdown-item drop__item" href="#"><i
                                    class="ic-map__header"></i> <?= $header_adress; ?></a>
                        <?php endif; ?>
                        <?php $header_email = get_field('header_email', 'option');
                        if ($header_email) : ?>
                        <a class="dropdown-item drop__item drop__item_mail" href="mailto:<?= $header_email; ?>"><i
                                    class="ic-mail__header"></i><span><?= $header_email; ?></span></a>
                        <?php endif; ?>
                    </div>
                </div>


                @if(!is_user_logged_in())
                    <a href="#" class="vhod" data-toggle="modal" data-target="#Modal">
                        <i class="ic-user"></i>
                        <p>Вход <span>/</span> Регистрация</p></a>
                @endif
                @if(is_user_logged_in())
                    <div class="dropdown dropdown__header dropdown__header_autor">
                        <a class="btn btn-secondary drop__btn dropdown-toggle auth_user" href="#" role="button"
                           id="dropdownMenuLink"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ic-user_check"></i>
                            <p>{{ $current_user->user_firstname }} {{ $current_user->user_lastname }}</p>
                            <i class="ic-arrow_down"></i>
                        </a>
                        <div class="dropdown-menu dropdown__header__menu" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown_text_desc">Ваш аккаунт</div>
                            <a class="dropdown-item drop__item" href="/profile">Настройки</a>
                            <a class="dropdown-item drop__item" href="/history">Заказы</a>
                            <div class="dropdown-item drop__item js-prevent-click">
                                <switch-catalog-column label="Скрыть цены"
                                                       slug="rrp"
                                                       :value="{{ json_encode($user->hasHiddenColumn('rrp')) }}"
                                ></switch-catalog-column>
                            </div>
                            <div class="dropdown-item drop__item js-prevent-click">
                                <switch-catalog-column label="Скрыть опт. цены"
                                                       slug="price"
                                                       :value="{{ json_encode($user->hasHiddenColumn('price')) }}"
                                ></switch-catalog-column>
                            </div>
                            <a class="dropdown-item drop__item drop__item_color"
                               href="{{ wp_logout_url('/') }}">Выйти</a>
                        </div>
                    </div>
                @endif
                <simple-cart cart-url="{{ wc_get_cart_url() }}"
                             :cart-items='@json($cartItems)'
                             user-group="{{ $user->getGroup() }}"
                             user-group-mixed="{{ $user->getGroupMixed() }}"
                             :user-logged="{{ json_encode(is_user_logged_in()) }}"
                >
                </simple-cart>
            </header><!-- /header -->

@include('popup.default')
