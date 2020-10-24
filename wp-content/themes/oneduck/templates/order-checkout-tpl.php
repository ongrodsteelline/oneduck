<?php
/**
 * Template Name: Order checkout
 */
get_header();
?>

<main style="opacity: .2;" class="main">
                <div class="order__checkout">
                    <h1>Оформить заказ <span>3490.56 BYN / 22 тов.</span></h1>
                    <p>Заказы обрабатываются с понедельника по пятницу, с 08:00 до 19:00.</p>
                    <p>После оформления заказа с вами свяжется наш менеджер для уточнения деталей заказа.</p>
                    <p>Пожалуйста, ответьте на несколько вопросов, для завершения выполнения заказа.</p>
                    <div class="order__info js-order__info">
                        <div class="order__info__delivery js-order__info__delivery">
                            <h4>Нужна доставка?</h4>
                            <div class="switch-wrap form__switch">
                                <label class="switch">
                                    <input type="checkbox" class="js-checkbox__adress">
                                    <span class="switch__btn"></span>
                                </label>
                            </div>
                            <p>Доставка будет осуществлена по адресу </p>
                            <div class="adress__field__wrap">
                                <p class="p_b js-adress__field">г. Минск, ул. Матусевича 64, оф. 105</p><i class="js-btn__adress btn__adress"></i>
                            </div>
                            <div class="edit_adress">
                                <input type="text" class="js-inp__vvod__adress" value="г. Минск, ул. Тимишенко 15">
                                <button class="js-btn__adress_new">OK</button>
                            </div>
                        </div>
                        <div class="order__info__pay">
                            <h4>Способ оплаты</h4>
                            <div class="switch-wrap form__switch js-switch-pay">
                                <label class="switch">
                                    <input type="radio" class="js-check__pay" name="pay">
                                    <span class="switch__btn"></span>
                                    <span class="switch__text">Первая форма</span>
                                </label>
                            </div>
                            <div class="switch-wrap form__switch js-switch-pay">
                                <label class="switch">
                                    <input type="radio" class="js-check__pay" name="pay">
                                    <span class="switch__btn"></span>
                                    <span class="switch__text">Вторая форма</span>
                                </label>
                            </div>
                            <div class="switch-wrap form__switch js-switch-pay">
                                <label class="switch">
                                    <input type="radio" class="js-check__pay" name="pay">
                                    <span class="switch__btn"></span>
                                    <span class="switch__text">Смешанная форма</span>
                                </label>
                            </div>
                        </div>
                        <div class="order__info__comment">
                            <h4>Комментарий</h4>
                            <textarea></textarea>
                        </div>
                    </div>
                    <a href="/order-completed" class="btn_order">ОФОРМИТЬ ЗАКАЗ</a>
                </div><!-- /order__checkout -->
            </main>

<?php get_footer(); ?>