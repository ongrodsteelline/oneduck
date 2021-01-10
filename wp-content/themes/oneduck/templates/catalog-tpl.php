<?php
/**
 * Template Name: Catalog
 */
get_header();
?>
    <main class="main main__pd main_table">
        <section class="catalog">
            <h1>Абразивные материалы</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item breadcrumb__item"><a href="#">Абразив</a></li>
                    <li class="breadcrumb-item breadcrumb__item active" aria-current="page">
                        <span>Материалы</span></li>
                </ol>
            </nav>
            <div class="table__wrap">

                <div class="switch-wrap form__switch">
                    <label class="switch">
                        <input type="checkbox" class="js-dop_table">
                        <span class="switch__btn"></span>
                        <span class="switch__text">Показать доп. характеристики</span>
                    </label>
                </div>

                <table class="table">
                    <thead>
                    <tr>
                        <th class="table__img">Фото</th>
                        <th class="table__name">Название</th>
                        <th class="table__article">Артикул</th>
                        <th class="table__brend">Бренд <span><i class="ic-filter_up"></i><i class="ic-filter_down"></i></span>
                        </th>
                        <th class="table__multiplicity">Кратность
                            <i class="ic-info js-info" data-toggle="tooltip" data-placement="left"
                               title="Вы можете заказать товар только в количестве, кратном указанном"></i>
                        </th>
                        <th class="table__izmer">Ед. изм.</th>
                        <th class="table__scale">Наличие <span><i class="ic-filter_up"></i><i
                                        class="ic-filter_down"></i></span></th>
                        <th class="table__PPC">РРЦ, <span>руб</span></th>
                        <th class="table__cena">Цена, <span>руб</span> <span><i class="ic-filter_up"></i><i
                                        class="ic-filter_down"></i></span></th>
                        <th class="table__basket">В корзину</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="js-tr__wrap">
                        <td class="table__img" data-toggle="modal" data-target="#Modal__img">
                            <div>
                                <img src="assets/img/main/table/tovar/1.jpg" alt="">
                                <span class="js-info info_error" data-toggle="tooltip" data-placement="right"
                                      title="Проверьте кратность"></span>
                                <span class="js-info info_success" data-toggle="tooltip" data-placement="right"
                                      title="Успешно добавлено"></span>
                            </div>
                        </td>
                        <td class="table__name">Выпуск для умыв. click/clack цельномет. ДУ-32 пробка 62 мм с переливом
                            A392
                            <p><span>Бренд:</span> Акватехника</p>
                            <div>
                                <div>Бренд:
                                    <p>Акватехника</p>
                                </div>
                                <div>Арт.:
                                    <p>АА9293РК-332</p>
                                </div>
                                <div>Кратность:
                                    <p>3 / 15 / 150</p>
                                </div>
                                <div>Ед. изм.: <p>шт.</p></div>
                                <div class="table__scale table__scale_max">
                                    Наличие:
                                    <div></div>
                                </div>
                            </div>
                        </td>
                        <td class="table__article">АА9293РК-332</td>
                        <td class="table__brend">Акватехника</td>
                        <td class="table__multiplicity js-multiplicity">3 / 15 / 150</td>
                        <td class="table__izmer">шт.</td>
                        <td class="table__scale table__scale_max">
                            <div></div>
                        </td>
                        <td class="table__PPC">16.00</td>
                        <td class="table__cena">
                            <span>5.60</span>
                            <p>≈$2.3 / € 1.9</p>
                        </td>
                        <td class="table__basket">
                            <span>2485.60 р.</span>
                            <div class="stepper stepper--style-1 js-spinner">
                                <input autofocus type="number" min="0" step="3" value="0"
                                       class="stepper__input js-stepper__input">
                                <div class="stepper__controls">
                                    <button type="button" spinner-button="up">+</button>
                                    <button type="button" spinner-button="down">−</button>
                                </div>
                            </div>
                        </td>
                        <td class="table__mob js-table__mob show">
                            <table>
                                <tr>
                                    <td><span>Артикул:</span>
                                        <p>АА9293РК-3324311</p></td>
                                    <td><span>Кратность:</span>
                                        <p>1 / 15 / 150</p></td>
                                    <td><span>Ед.изм:</span>
                                        <p>м.п</p></td>
                                    <td><span>РРЦ:</span>
                                        <p>345 р.</p></td>
                                    <td class="table__scale table__scale_max"><span>Наличие:</span>
                                        <div></div>
                                    </td>
                                </tr>
                            </table>
                            <span class="js-scroll__hands"><i class="ic-hands"></i></span>
                        </td>
                    </tr>
                    <tr class="js-tr__wrap">
                        <td class="table__img" data-toggle="modal" data-target="#Modal__img">
                            <div>
                                <img src="assets/img/main/table/tovar/2.jpg" alt="">
                                <span class="js-info info_error" data-toggle="tooltip" data-placement="right"
                                      title="Проверьте кратность"></span>
                                <span class="js-info info_success" data-toggle="tooltip" data-placement="right"
                                      title="Успешно добавлено"></span>
                            </div>
                        </td>
                        <td class="table__name">Заливной клапан Ани Пласт ниж/подв. WC5510 АНИ пласт
                            <p><span>Бренд:</span> Акватехника</p>
                            <div>
                                <div>Бренд:
                                    <p>Акватехника</p>
                                </div>
                                <div>Арт.:
                                    <p>АА9293РК-332</p>
                                </div>
                                <div>Кратность:
                                    <p>2 / 15 / 150</p>
                                </div>
                                <div>Ед. изм.: <p>шт.</p></div>
                                <div class="table__scale table__scale_max">
                                    Наличие:
                                    <div></div>
                                </div>
                            </div>
                        </td>
                        <td class="table__article">RE8200</td>
                        <td class="table__brend">Анипласт</td>
                        <td class="table__multiplicity js-multiplicity">2 / 15 / 150</td>
                        <td class="table__izmer">шт.</td>
                        <td class="table__scale table__scale_sr">
                            <div></div>
                        </td>
                        <td class="table__PPC">17.04</td>
                        <td class="table__cena">
                            <span>11.60</span>
                            <p>≈$2.3 / € 1.9</p>
                        </td>
                        <td class="table__basket">
                            <span>2485.60 р.</span>
                            <div class="stepper stepper--style-1 js-spinner">
                                <input autofocus type="number" min="0" step="2" value="0"
                                       class="stepper__input js-stepper__input">
                                <div class="stepper__controls">
                                    <button type="button" spinner-button="up">+</button>
                                    <button type="button" spinner-button="down">−</button>
                                </div>
                            </div>
                        </td>
                        <td class="table__mob js-table__mob show">
                            <table>
                                <tr>
                                    <td><span>Артикул:</span>
                                        <p>АА9293РК-3324311</p></td>
                                    <td><span>Кратность:</span>
                                        <p>1 / 15 / 150</p></td>
                                    <td><span>Ед.изм:</span>
                                        <p>м.п</p></td>
                                    <td><span>РРЦ:</span>
                                        <p>345 р.</p></td>
                                    <td class="table__scale table__scale_max"><span>Наличие:</span>
                                        <div></div>
                                    </td>
                                </tr>
                            </table>
                            <span class="js-scroll__hands"><i class="ic-hands"></i></span>
                        </td>
                    </tr>
                    <tr class="js-tr__wrap">
                        <td class="table__img" data-toggle="modal" data-target="#Modal__img">
                            <div>
                                <img src="assets/img/main/table/tovar/3.jpg" alt="">
                                <span class="js-info info_error" data-toggle="tooltip" data-placement="right"
                                      title="Проверьте кратность"></span>
                                <span class="js-info info_success" data-toggle="tooltip" data-placement="right"
                                      title="Успешно добавлено"></span>
                            </div>
                        </td>
                        <td class="table__name">Арматура к смыв. бачку 2-х Кноп. Уклад метал. бок. подв унив колонка D40
                            (аб77. 54. 14. 3)
                            <p><span>Бренд:</span> Акватехника</p>
                            <div>
                                <div>Бренд:
                                    <p>Акватехника</p>
                                </div>
                                <div>Арт.:
                                    <p>АА9293РК-332</p>
                                </div>
                                <div>Кратность:
                                    <p>2 / 15 / 150</p>
                                </div>
                                <div>Ед. изм.: <p>шт.</p></div>
                                <div class="table__scale table__scale_max">
                                    Наличие:
                                    <div></div>
                                </div>
                            </div>
                        </td>
                        <td class="table__article">КК9002-1</td>
                        <td class="table__brend">Кинетика Аква</td>
                        <td class="table__multiplicity js-multiplicity">15 / 150</td>
                        <td class="table__izmer">компл.</td>
                        <td class="table__scale table__scale_min">
                            <div></div>
                        </td>
                        <td class="table__PPC">1142.35</td>
                        <td class="table__cena">
                            <span>993.44</span>
                            <p>≈$341.1 / € 312.2</p>
                        </td>
                        <td class="table__basket">
                            <span>2485.60 р.</span>
                            <div class="stepper stepper--style-1 js-spinner">
                                <input autofocus type="number" min="0" step="15" value="0"
                                       class="stepper__input js-stepper__input">
                                <div class="stepper__controls">
                                    <button type="button" spinner-button="up">+</button>
                                    <button type="button" spinner-button="down">−</button>
                                </div>
                            </div>
                        </td>
                        <td class="table__mob js-table__mob show">
                            <table>
                                <tr>
                                    <td><span>Артикул:</span>
                                        <p>АА9293РК-3324311</p></td>
                                    <td><span>Кратность:</span>
                                        <p>1 / 15 / 150</p></td>
                                    <td><span>Ед.изм:</span>
                                        <p>м.п</p></td>
                                    <td><span>РРЦ:</span>
                                        <p>345 р.</p></td>
                                    <td class="table__scale table__scale_max"><span>Наличие:</span>
                                        <div></div>
                                    </td>
                                </tr>
                            </table>
                            <span class="js-scroll__hands"><i class="ic-hands"></i></span>
                        </td>
                    </tr>
                    <tr class="js-tr__wrap">
                        <td class="table__img" data-toggle="modal" data-target="#Modal__img">
                            <div>
                                <img src="assets/img/main/table/tovar/1.jpg" alt="">
                                <span class="js-info info_error" data-toggle="tooltip" data-placement="right"
                                      title="Проверьте кратность"></span>
                                <span class="js-info info_success" data-toggle="tooltip" data-placement="right"
                                      title="Успешно добавлено"></span>
                            </div>
                        </td>
                        <td class="table__name">Выпуск для умыв. click/clack цельномет. ДУ-32 пробка 62 мм с переливом
                            A392
                            <p><span>Бренд:</span> Акватехника</p>
                            <div>
                                <div>Бренд:
                                    <p>Акватехника</p>
                                </div>
                                <div>Арт.:
                                    <p>АА9293РК-332</p>
                                </div>
                                <div>Кратность:
                                    <p>2 / 15 / 150</p>
                                </div>
                                <div>Ед. изм.: <p>шт.</p></div>
                                <div class="table__scale table__scale_max">
                                    Наличие:
                                    <div></div>
                                </div>
                            </div>
                        </td>
                        <td class="table__article">АА9293РК-332</td>
                        <td class="table__brend">Акватехника</td>
                        <td class="table__multiplicity js-multiplicity">3 / 15 / 150</td>
                        <td class="table__izmer">шт.</td>
                        <td class="table__scale table__scale_max">
                            <div></div>
                        </td>
                        <td class="table__PPC">16.00</td>
                        <td class="table__cena">
                            <span>5.60</span>
                            <p>≈$2.3 / € 1.9</p>
                        </td>
                        <td class="table__basket">
                            <span>2485.60 р.</span>
                            <div class="stepper stepper--style-1 js-spinner">
                                <input autofocus type="number" min="0" step="3" value="0"
                                       class="stepper__input js-stepper__input">
                                <div class="stepper__controls">
                                    <button type="button" spinner-button="up">+</button>
                                    <button type="button" spinner-button="down">−</button>
                                </div>
                            </div>
                        </td>
                        <td class="table__mob js-table__mob show">
                            <table>
                                <tr>
                                    <td><span>Артикул:</span>
                                        <p>АА9293РК-3324311</p></td>
                                    <td><span>Кратность:</span>
                                        <p>1 / 15 / 150</p></td>
                                    <td><span>Ед.изм:</span>
                                        <p>м.п</p></td>
                                    <td><span>РРЦ:</span>
                                        <p>345 р.</p></td>
                                    <td class="table__scale table__scale_max"><span>Наличие:</span>
                                        <div></div>
                                    </td>
                                </tr>
                            </table>
                            <span class="js-scroll__hands"><i class="ic-hands"></i></span>
                        </td>
                    </tr>
                    <tr class="js-tr__wrap">
                        <td class="table__img" data-toggle="modal" data-target="#Modal__img">
                            <div>
                                <img src="assets/img/main/table/tovar/1.jpg" alt="">
                                <span class="js-info info_error" data-toggle="tooltip" data-placement="right"
                                      title="Проверьте кратность"></span>
                                <span class="js-info info_success" data-toggle="tooltip" data-placement="right"
                                      title="Успешно добавлено"></span>
                            </div>
                        </td>
                        <td class="table__name">Выпуск для умыв. click/clack цельномет. ДУ-32 пробка 62 мм с переливом
                            A392
                            <p><span>Бренд:</span> Акватехника</p>
                            <div>
                                <div>Бренд:
                                    <p>Акватехника</p>
                                </div>
                                <div>Арт.:
                                    <p>АА9293РК-332</p>
                                </div>
                                <div>Кратность:
                                    <p>2 / 15 / 150</p>
                                </div>
                                <div>Ед. изм.: <p>шт.</p></div>
                                <div class="table__scale table__scale_max">
                                    Наличие:
                                    <div></div>
                                </div>
                            </div>
                        </td>
                        <td class="table__article">АА9293РК-332</td>
                        <td class="table__brend">Акватехника</td>
                        <td class="table__multiplicity js-multiplicity">3 / 15 / 150</td>
                        <td class="table__izmer">шт.</td>
                        <td class="table__scale table__scale_max">
                            <div></div>
                        </td>
                        <td class="table__PPC">16.00</td>
                        <td class="table__cena">
                            <span>5.60</span>
                            <p>≈$2.3 / € 1.9</p>
                        </td>
                        <td class="table__basket">
                            <span>2485.60 р.</span>
                            <div class="stepper stepper--style-1 js-spinner">
                                <input autofocus type="number" min="0" step="3" value="0"
                                       class="stepper__input js-stepper__input">
                                <div class="stepper__controls">
                                    <button type="button" spinner-button="up">+</button>
                                    <button type="button" spinner-button="down">−</button>
                                </div>
                            </div>
                        </td>
                        <td class="table__mob js-table__mob show">
                            <table>
                                <tr>
                                    <td><span>Артикул:</span>
                                        <p>АА9293РК-3324311</p></td>
                                    <td><span>Кратность:</span>
                                        <p>1 / 15 / 150</p></td>
                                    <td><span>Ед.изм:</span>
                                        <p>м.п</p></td>
                                    <td><span>РРЦ:</span>
                                        <p>345 р.</p></td>
                                    <td class="table__scale table__scale_max"><span>Наличие:</span>
                                        <div></div>
                                    </td>
                                </tr>
                            </table>
                            <span class="js-scroll__hands"><i class="ic-hands"></i></span>
                        </td>
                    </tr>
                    <tr class="js-tr__wrap">
                        <td class="table__img" data-toggle="modal" data-target="#Modal__img">
                            <div>
                                <img src="assets/img/main/table/tovar/1.jpg" alt="">
                                <span class="js-info info_error" data-toggle="tooltip" data-placement="right"
                                      title="Проверьте кратность"></span>
                                <span class="js-info info_success" data-toggle="tooltip" data-placement="right"
                                      title="Успешно добавлено"></span>
                            </div>
                        </td>
                        <td class="table__name">Выпуск для умыв. click/clack цельномет. ДУ-32 пробка 62 мм с переливом
                            A392
                            <p><span>Бренд:</span> Акватехника</p>
                            <div>
                                <div>Бренд:
                                    <p>Акватехника</p>
                                </div>
                                <div>Арт.:
                                    <p>АА9293РК-332</p>
                                </div>
                                <div>Кратность:
                                    <p>2 / 15 / 150</p>
                                </div>
                                <div>Ед. изм.: <p>шт.</p></div>
                                <div class="table__scale table__scale_max">
                                    Наличие:
                                    <div></div>
                                </div>
                            </div>
                        </td>
                        <td class="table__article">АА9293РК-332</td>
                        <td class="table__brend">Акватехника</td>
                        <td class="table__multiplicity js-multiplicity">3 / 15 / 150</td>
                        <td class="table__izmer">шт.</td>
                        <td class="table__scale table__scale_max">
                            <div></div>
                        </td>
                        <td class="table__PPC">16.00</td>
                        <td class="table__cena">
                            <span>5.60</span>
                            <p>≈$2.3 / € 1.9</p>
                        </td>
                        <td class="table__basket">
                            <span>2485.60 р.</span>
                            <div class="stepper stepper--style-1 js-spinner">
                                <input autofocus type="number" min="0" step="3" value="0"
                                       class="stepper__input js-stepper__input">
                                <div class="stepper__controls">
                                    <button type="button" spinner-button="up">+</button>
                                    <button type="button" spinner-button="down">−</button>
                                </div>
                            </div>
                        </td>
                        <td class="table__mob js-table__mob show">
                            <table>
                                <tr>
                                    <td><span>Артикул:</span>
                                        <p>АА9293РК-3324311</p></td>
                                    <td><span>Кратность:</span>
                                        <p>1 / 15 / 150</p></td>
                                    <td><span>Ед.изм:</span>
                                        <p>м.п</p></td>
                                    <td><span>РРЦ:</span>
                                        <p>345 р.</p></td>
                                    <td class="table__scale table__scale_max"><span>Наличие:</span>
                                        <div></div>
                                    </td>
                                </tr>
                            </table>
                            <span class="js-scroll__hands"><i class="ic-hands"></i></span>
                        </td>
                    </tr>
                    <tr class="js-tr__wrap">
                        <td class="table__img" data-toggle="modal" data-target="#Modal__img">
                            <div>
                                <img src="assets/img/main/table/tovar/1.jpg" alt="">
                                <span class="js-info info_error" data-toggle="tooltip" data-placement="right"
                                      title="Проверьте кратность"></span>
                                <span class="js-info info_success" data-toggle="tooltip" data-placement="right"
                                      title="Успешно добавлено"></span>
                            </div>
                        </td>
                        <td class="table__name">Выпуск для умыв. click/clack цельномет. ДУ-32 пробка 62 мм с переливом
                            A392
                            <p><span>Бренд:</span> Акватехника</p>
                            <div>
                                <div>Бренд:
                                    <p>Акватехника</p>
                                </div>
                                <div>Арт.:
                                    <p>АА9293РК-332</p>
                                </div>
                                <div>Кратность:
                                    <p>2 / 15 / 150</p>
                                </div>
                                <div>Ед. изм.: <p>шт.</p></div>
                                <div class="table__scale table__scale_max">
                                    Наличие:
                                    <div></div>
                                </div>
                            </div>
                        </td>
                        <td class="table__article">АА9293РК-332</td>
                        <td class="table__brend">Акватехника</td>
                        <td class="table__multiplicity js-multiplicity">3 / 15 / 150</td>
                        <td class="table__izmer">шт.</td>
                        <td class="table__scale table__scale_max">
                            <div></div>
                        </td>
                        <td class="table__PPC">16.00</td>
                        <td class="table__cena">
                            <span>5.60</span>
                            <p>≈$2.3 / € 1.9</p>
                        </td>
                        <td class="table__basket">
                            <span>2485.60 р.</span>
                            <div class="stepper stepper--style-1 js-spinner">
                                <input autofocus type="number" min="0" step="3" value="0"
                                       class="stepper__input js-stepper__input">
                                <div class="stepper__controls">
                                    <button type="button" spinner-button="up">+</button>
                                    <button type="button" spinner-button="down">−</button>
                                </div>
                            </div>
                        </td>
                        <td class="table__mob js-table__mob show">
                            <table>
                                <tr>
                                    <td><span>Артикул:</span>
                                        <p>АА9293РК-3324311</p></td>
                                    <td><span>Кратность:</span>
                                        <p>1 / 15 / 150</p></td>
                                    <td><span>Ед.изм:</span>
                                        <p>м.п</p></td>
                                    <td><span>РРЦ:</span>
                                        <p>345 р.</p></td>
                                    <td class="table__scale table__scale_max"><span>Наличие:</span>
                                        <div></div>
                                    </td>
                                </tr>
                            </table>
                            <span class="js-scroll__hands"><i class="ic-hands"></i></span>
                        </td>
                    </tr>
                    <tr class="js-tr__wrap">
                        <td class="table__img" data-toggle="modal" data-target="#Modal__img">
                            <div>
                                <img src="assets/img/main/table/tovar/1.jpg" alt="">
                                <span class="js-info info_error" data-toggle="tooltip" data-placement="right"
                                      title="Проверьте кратность"></span>
                                <span class="js-info info_success" data-toggle="tooltip" data-placement="right"
                                      title="Успешно добавлено"></span>
                            </div>
                        </td>
                        <td class="table__name">Выпуск для умыв. click/clack цельномет. ДУ-32 пробка 62 мм с переливом
                            A392
                            <p><span>Бренд:</span> Акватехника</p>
                            <div>
                                <div>Бренд:
                                    <p>Акватехника</p>
                                </div>
                                <div>Арт.:
                                    <p>АА9293РК-332</p>
                                </div>
                                <div>Кратность:
                                    <p>2 / 15 / 150</p>
                                </div>
                                <div>Ед. изм.: <p>шт.</p></div>
                                <div class="table__scale table__scale_max">
                                    Наличие:
                                    <div></div>
                                </div>
                            </div>
                        </td>
                        <td class="table__article">АА9293РК-332</td>
                        <td class="table__brend">Акватехника</td>
                        <td class="table__multiplicity js-multiplicity">3 / 15 / 150</td>
                        <td class="table__izmer">шт.</td>
                        <td class="table__scale table__scale_max">
                            <div></div>
                        </td>
                        <td class="table__PPC">16.00</td>
                        <td class="table__cena">
                            <span>5.60</span>
                            <p>≈$2.3 / € 1.9</p>
                        </td>
                        <td class="table__basket">
                            <span>2485.60 р.</span>
                            <div class="stepper stepper--style-1 js-spinner">
                                <input autofocus type="number" min="0" step="3" value="0"
                                       class="stepper__input js-stepper__input">
                                <div class="stepper__controls">
                                    <button type="button" spinner-button="up">+</button>
                                    <button type="button" spinner-button="down">−</button>
                                </div>
                            </div>
                        </td>
                        <td class="table__mob js-table__mob show">
                            <table>
                                <tr>
                                    <td><span>Артикул:</span>
                                        <p>АА9293РК-3324311</p></td>
                                    <td><span>Кратность:</span>
                                        <p>1 / 15 / 150</p></td>
                                    <td><span>Ед.изм:</span>
                                        <p>м.п</p></td>
                                    <td><span>РРЦ:</span>
                                        <p>345 р.</p></td>
                                    <td class="table__scale table__scale_max"><span>Наличие:</span>
                                        <div></div>
                                    </td>
                                </tr>
                            </table>
                            <span class="js-scroll__hands"><i class="ic-hands"></i></span>
                        </td>
                    </tr>
                    <tr class="js-tr__wrap">
                        <td class="table__img" data-toggle="modal" data-target="#Modal__img">
                            <div>
                                <img src="assets/img/main/table/tovar/1.jpg" alt="">
                                <span class="js-info info_error" data-toggle="tooltip" data-placement="right"
                                      title="Проверьте кратность"></span>
                                <span class="js-info info_success" data-toggle="tooltip" data-placement="right"
                                      title="Успешно добавлено"></span>
                            </div>
                        </td>
                        <td class="table__name">Выпуск для умыв. click/clack цельномет. ДУ-32 пробка 62 мм с переливом
                            A392
                            <p><span>Бренд:</span> Акватехника</p>
                            <div>
                                <div>Бренд:
                                    <p>Акватехника</p>
                                </div>
                                <div>Арт.:
                                    <p>АА9293РК-332</p>
                                </div>
                                <div>Кратность:
                                    <p>2 / 15 / 150</p>
                                </div>
                                <div>Ед. изм.: <p>шт.</p></div>
                                <div class="table__scale table__scale_max">
                                    Наличие:
                                    <div></div>
                                </div>
                            </div>
                        </td>
                        <td class="table__article">АА9293РК-332</td>
                        <td class="table__brend">Акватехника</td>
                        <td class="table__multiplicity js-multiplicity">3 / 15 / 150</td>
                        <td class="table__izmer">шт.</td>
                        <td class="table__scale table__scale_max">
                            <div></div>
                        </td>
                        <td class="table__PPC">16.00</td>
                        <td class="table__cena">
                            <span>5.60</span>
                            <p>≈$2.3 / € 1.9</p>
                        </td>
                        <td class="table__basket">
                            <span>2485.60 р.</span>
                            <div class="stepper stepper--style-1 js-spinner">
                                <input autofocus type="number" min="0" step="3" value="0"
                                       class="stepper__input js-stepper__input">
                                <div class="stepper__controls">
                                    <button type="button" spinner-button="up">+</button>
                                    <button type="button" spinner-button="down">−</button>
                                </div>
                            </div>
                        </td>
                        <td class="table__mob js-table__mob show">
                            <table>
                                <tr>
                                    <td><span>Артикул:</span>
                                        <p>АА9293РК-3324311</p></td>
                                    <td><span>Кратность:</span>
                                        <p>1 / 15 / 150</p></td>
                                    <td><span>Ед.изм:</span>
                                        <p>м.п</p></td>
                                    <td><span>РРЦ:</span>
                                        <p>345 р.</p></td>
                                    <td class="table__scale table__scale_max"><span>Наличие:</span>
                                        <div></div>
                                    </td>
                                </tr>
                            </table>
                            <span class="js-scroll__hands"><i class="ic-hands"></i></span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <nav aria-label="Page navigation example" class="pagination__wrap">
                <ul class="pagination"><span>Страница:</span>
                    <li class="page-item pagination__item">
                        <a class="page-link pagination__link" href="#" aria-label="Previous">1</a>
                    </li>
                    <li class="page-item"><a class="page-link pagination__link" href="#">2</a></li>
                    <li class="page-item pagination__item active"><a class="page-link pagination__link"
                                                                     href="#">3</a></li>
                    <li class="page-item pagination__item pagination__item_dis"><a class="page-link pagination__link"
                                                                                   href="#">4</a>
                    </li>
                    <li class="page-item pagination__item pagination__item_dis"><a class="page-link pagination__link"
                                                                                   href="#">5</a>
                    </li>
                    <li class="page-item pagination__item pagination__item_dis"><a class="page-link pagination__link"
                                                                                   href="#">6</a>
                    </li>
                    <li class="page-item pagination__item"><a class="page-link pagination__link"
                                                              href="#">...</a></li>
                    <li class="page-item pagination__item">
                        <a class="page-link pagination__link" href="#" aria-label="Next">43</a>
                    </li>
                </ul>
                <div>
                    <span>Показывать по:</span>
                    <select>
                        <option>10</option>
                        <option>20</option>
                        <option>50</option>
                        <option>100</option>
                    </select>
                </div>

            </nav>
            <p>Производство зерна и зернобобовых начинает культурный особый вид куниц, хорошо, что в российском
                посольстве есть медпункт. Длина автодорог точно притягивает бассейн нижнего Инда. Море
                стабильно. Пустыня пространственно выбирает культурный знаменитый Фогель-маркет на
                Оудевард-плаатс, здесь сохранились остатки построек древнего римского поселения Аквинка -
                "Аквинкум". Королевство прочно надкусывает различный органический мир. Озеро Титикака перевозит
                широколиственный лес.</p>
            <p>Бурное развитие внутреннего туризма привело Томаса Кука к необходимости организовать поездки за
                границу, при этом температура берёт подземный сток. Материк, в первом приближении, выбирает
                широкий кандым. Бессточное солоноватое озеро, несмотря на то, что в воскресенье некоторые
                станции метро закрыты, поднимает глубокий кит. Бурное развитие внутреннего туризма привело
                Томаса Кука к необходимости организовать поездки за границу, при этом пустыня дегустирует
                памятник Средневековья. Праздник франко-говорящего культурного сообщества связывает круговорот
                машин вокруг статуи Эроса.</p>
        </section><!-- /catalog -->

        <div class="main__filter__wrap js-main__filter__wrap">
            <div class="main__filter">
                <div class="main__filter__top">
                    <input type="text" placeholder="Поиск в категории...">

                    <div class="param param_nth js-param">
                        <h4>ПРОИЗВОДИТЕЛЬ</h4>
                        <label class="param__check js-param__check">Aviteka
                            <input type="checkbox" class="js-input_box">
                            <span class="checkmark"></span>
                        </label>
                        <label class="param__check">Monrial Recotta
                            <input type="checkbox" class="js-input_box">
                            <span class="checkmark"></span>
                        </label>
                        <label class="param__check">Civali Ametici
                            <input type="checkbox" class="js-input_box">
                            <span class="checkmark"></span>
                        </label>
                        <label class="param__check">Olevia
                            <input type="checkbox" class="js-input_box">
                            <span class="checkmark"></span>
                        </label>
                        <label class="param__check">Kila
                            <input type="checkbox" class="js-input_box">
                            <span class="checkmark"></span>
                        </label>
                        <label class="param__check">Olevia
                            <input type="checkbox" class="js-input_box">
                            <span class="checkmark"></span>
                        </label>
                        <label class="param__check">Aviteka
                            <input type="checkbox" class="js-input_box">
                            <span class="checkmark"></span>
                        </label>
                        <label class="param__check">Civali
                            <input type="checkbox" class="js-input_box">
                            <span class="checkmark"></span>
                        </label>
                        <label class="param__check">Aviteka
                            <input type="checkbox" class="js-input_box">
                            <span class="checkmark"></span>
                        </label>
                        <button class="more js-more">показать еще <span class="js-not_visible">17</span></button>
                        <button class="show_check js-show_check">свернуть не выбранное</button>
                    </div>
                    <div class="param js-param">
                        <h4>ДИАМЕТР</h4>
                        <label class="param__check">10.5’’
                            <input type="checkbox" class="js-input_box">
                            <span class="checkmark"></span>
                        </label>
                        <label class="param__check">14’’
                            <input type="checkbox" class="js-input_box">
                            <span class="checkmark"></span>
                        </label>
                        <label class="param__check">18’’
                            <input type="checkbox" class="js-input_box">
                            <span class="checkmark"></span>
                        </label>
                        <label class="param__check">20.5’’
                            <input type="checkbox" class="js-input_box">
                            <span class="checkmark"></span>
                        </label>
                        <label class="param__check">25’’
                            <input type="checkbox" class="js-input_box">
                            <span class="checkmark"></span>
                        </label>
                        <label class="param__check">18’’
                            <input type="checkbox" class="js-input_box">
                            <span class="checkmark"></span>
                        </label>
                        <label class="param__check">25’’
                            <input type="checkbox" class="js-input_box">
                            <span class="checkmark"></span>
                        </label>
                        <label class="param__check">18’’
                            <input type="checkbox" class="js-input_box">
                            <span class="checkmark"></span>
                        </label>
                        <label class="param__check">25’’
                            <input type="checkbox" class="js-input_box">
                            <span class="checkmark"></span>
                        </label>
                        <button class="more js-more">показать еще <span class="js-not_visible">17</span></button>
                        <button class="show_check js-show_check">свернуть не выбранное</button>
                    </div>
                    <div class="param param_nth js-param">
                        <h4>ДЛИНА</h4>
                        <label class="param__check">14 см
                            <input type="checkbox" class="js-input_box">
                            <span class="checkmark"></span>
                        </label>
                        <label class="param__check">16 см
                            <input type="checkbox" class="js-input_box">
                            <span class="checkmark"></span>
                        </label>
                        <label class="param__check">20 см
                            <input type="checkbox" class="js-input_box">
                            <span class="checkmark"></span>
                        </label>
                        <label class="param__check">22 см
                            <input type="checkbox" class="js-input_box">
                            <span class="checkmark"></span>
                        </label>
                        <label class="param__check">24 см
                            <input type="checkbox" class="js-input_box">
                            <span class="checkmark"></span>
                        </label>
                        <label class="param__check">26 см
                            <input type="checkbox" class="js-input_box">
                            <span class="checkmark"></span>
                        </label>
                        <label class="param__check">28 см
                            <input type="checkbox" class="js-input_box">
                            <span class="checkmark"></span>
                        </label>
                        <label class="param__check">12 см
                            <input type="checkbox" class="js-input_box">
                            <span class="checkmark"></span>
                        </label>
                        <label class="param__check">14 см
                            <input type="checkbox" class="js-input_box">
                            <span class="checkmark"></span>
                        </label>
                        <button class="more js-more">показать еще <span class="js-not_visible">17</span></button>
                        <button class="show_check js-show_check">свернуть не выбранное</button>
                    </div>
                    <div class="switch-wrap form__switch">
                        <label class="switch">
                            <input type="checkbox" class="">
                            <span class="switch__btn"></span>
                            <span class="switch__text">С дозатором</span>
                        </label>
                    </div>
                    <div class="switch-wrap form__switch">
                        <label class="switch">
                            <input type="checkbox" class="">
                            <span class="switch__btn"></span>
                            <span class="switch__text">Крепление в комплекте</span>
                        </label>
                    </div>
                </div>
                <div class="main__filter__bot">
                    <div>
                        <i></i>
                        <p>По указанным фильтрам найдено <span>18</span> товаров.</p>
                    </div>
                    <button class="js-filter__clear">сбросить фильтры</button>
                    <div>
                        <i></i>
                        <p>В категории «Абразивные материалы» <span>1739</span> товаров.</p>
                    </div>
                </div>

            </div>
            <button class="js-filter_btn"><i></i><span>Свернуть фильтр</span><span>Развернуть
                            фильтр</span></button>
        </div>


    </main>
    <div style="opacity: 0.2;" class="preload__wrap">
        <div class="preload-juggle">
            <div class="ball"></div>
            <div class="ball"></div>
            <div class="ball"></div>
        </div>
    </div>

<?php get_footer(); ?>