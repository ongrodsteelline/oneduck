<div class="order__complited">
    <div><img src="{{ asset('static/img/main/order/finish.png') }}" alt=""></div>
    <div>
        <h1>Заказ <span>№{{ $order->get_id() }}</span> успешно оформлен</h1>
        <p>Заказы обрабатываются с понедельника по пятницу, с 08:00 до 19:00.</p>
        <p>Обработка заказа будет начата после его подтверждения по мобильному телефону. <br> Пожалуйста, ожидайте звонка менеджера.</p>
        <div><a href="/history/">ПЕРЕЙТИ К ИСТОРИИ ЗАКАЗОВ</a>
        <!--<a href="#"><i></i>СКАЧАТЬ СЧЕТ В PDF</a>-->
    </div>
    </div>
</div>