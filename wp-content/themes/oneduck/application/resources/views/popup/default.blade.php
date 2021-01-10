<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal__dialog js-modal__dialog" role="document">
        <div class="modal-content modal__content">
            <div class="modal-header modal__content__header">
                <h5 class="modal-title" id="exampleModalLabel">Авторизация</h5>
                <span data-dismiss="modal"></span>
            </div>
            <div class="modal-body modal__content__body">
                {!! my_login_form() !!}
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
                    <img src="{{ bloginfo('template_url') }}/app/assets/img/modal/finish.png" alt="">
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
                {!! my_registration_form() !!}
            </div>
        </div>
        <div class="modal-content modal__content modal__content_step">
            <div class="modal-header modal__content__header">
                <span data-dismiss="modal" class="js-btn__modal__close"></span>
            </div>
            <div class="modal-body modal__content__body">
                <form action="" class="form form_al">
                    <img src="{{ bloginfo('template_url') }}/app/assets/img/modal/process.png" alt="">
                    <h2 class="errorHide">Почти готово...</h2>
                    <h2 id="errorCode">Код введён неверно! <br> Попробуйте ещё раз.</h2>
                    <p class="errorHide">На ваш e-mail отправлен проверочный код.</p>
                    <p class="errorHide">Пожалуйста, введите его здесь.</p>
                    <div class="form__cod js-form__cod">
                        <input type="text" maxlength="4" class="js-validate__cod">
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
                    <img src="{{ bloginfo('template_url') }}/app/assets/img/modal/finish.png" alt="">
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