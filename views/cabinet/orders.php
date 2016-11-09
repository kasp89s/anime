<?php
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
?>
    <div class="breadcrumbs-block clearfix">
        <ul>
            <?php echo Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], 'homeLink' => false]);?>
        </ul>
    </div>
    <div class="content-container clearfix">
<?= $this->render('//cabinet/block/leftNavBar', []); ?>
        <div class="responsive-container left">
            <h3>
                МОИ ЗАКАЗЫ
            </h3>
            <div class="order-list">
                <div class="order-block">
                    <div class="order-info clearfix">
                        <div class="order-number left">
                                <span>
                                    Заказ <strong>#1805391</strong> от 19 марта 2016 г.
                                </span>
                            <span class="detail-button">
                                    Детали заказа
                                </span>
                        </div>
                        <div class="order-status right">
                                <span>
                                    Статус заказа:
                                </span>
                            <span class="done">
                                    ВЫПОЛНЕН
                                </span>
                        </div>

                        <div class="more-detail clearfix">
                            <p>
                                    <span>
                                        Способ оплаты:
                                    </span>
                                <span class="more-detail-title">
                                        Почтовый/банковский перевод
                                    </span>
                            </p>
                            <p>
                                    <span>
                                        Способ доставки:
                                    </span>
                                <span class="more-detail-title">
                                        Самовывоз из Новой Почты
                                    </span>
                            </p>
                            <p>
                                    <span>
                                        Покупатель:
                                    </span>
                                <span class="more-detail-title">
                                        Евгений Конорев
                                    </span>
                            </p>
                            <p>
                                    <span>
                                        Телефон:
                                    </span>
                                <span class="more-detail-title">
                                        +380 (99) 951-51-24
                                    </span>
                            </p>
                            <p>
                                    <span>
                                        Адрес пункта самовывоза:
                                    </span>
                                <span class="more-detail-title">
                                        Константиновка Донецкая обл., Отделение №2, пл. Победы, д. 16
                                    </span>
                            </p>
                            <p>
                                    <span>
                                       E-mail:
                                    </span>
                                <span class="more-detail-title">
                                        konarev93@gmail.com
                                    </span>
                            </p>
                            <p>
                                    <span>
                                       Номер ТТН:
                                    </span>
                                <span class="more-detail-title">
                                        <strong>
                                            20400004295107
                                        </strong>
                                    </span>
                            </p>
                        </div>
                    </div>
                    <div class="basket-table">
                        <div class="basket-row clearfix">
                            <div class="description left">
                                <div class="image left">
                                    <img src="/img/item2.png" alt="">
                                </div>
                                <div class="description-text left">
                                    <p class="description-name">
                                        Бэтмен. Книга 2. Город Сов
                                    </p>
                                    <p class="description-code">
                                        Код товара: MPZ036
                                    </p>
                                </div>
                            </div>
                            <div class="info-description right">
                                <div class="total-count right">
                                    <p class="info-title">
                                        Сумма:
                                    </p>
                                    <p>
                                        250 грн
                                    </p>
                                </div>
                                <div class="price right">
                                    <p class="info-title">
                                        Цена:
                                    </p>
                                    <p>
                                        250 грн
                                    </p>
                                </div>
                                <div class="counter right">
                                    <p class="info-title">
                                        Кол-во:
                                    </p>
                                    <p>
                                        1шт
                                    </p>
                                </div>



                            </div>
                        </div>
                        <div class="basket-row clearfix">
                            <div class="description left">
                                <div class="image left">
                                    <img src="/img/item2.png" alt="">
                                </div>
                                <div class="description-text left">
                                    <p class="description-name">
                                        Бэтмен. Книга 2. Город Сов
                                    </p>
                                    <p class="description-code">
                                        Код товара: MPZ036
                                    </p>
                                </div>
                            </div>
                            <div class="info-description right">
                                <div class="total-count right">
                                    <p class="info-title">
                                        Сумма:
                                    </p>
                                    <p>
                                        250 грн
                                    </p>
                                </div>
                                <div class="price right">
                                    <p class="info-title">
                                        Цена:
                                    </p>
                                    <p>
                                        250 грн
                                    </p>
                                </div>
                                <div class="counter right">
                                    <p class="info-title">
                                        Кол-во:
                                    </p>
                                    <p>
                                        1шт
                                    </p>
                                </div>



                            </div>
                        </div>
                    </div>
                    <div class="payment-status clearfix">
                        <p>
                            Всего к оплате
                            <strong>
                                500 грн.
                            </strong>
                        </p>
                    </div>
                </div>
                <div class="order-block">
                    <div class="order-info clearfix">
                        <div class="order-number left">
                                <span>
                                    Заказ <strong>#1805391</strong> от 19 марта 2016 г.
                                </span>
                            <span class="detail-button">
                                    Детали заказа
                                </span>
                        </div>
                        <div class="order-status right">
                                <span>
                                    Статус заказа:
                                </span>
                            <span class="cancel">
                                    ОТМЕНЕН
                                </span>
                        </div>

                        <div class="more-detail clearfix">
                            <p>
                                    <span>
                                        Способ оплаты:
                                    </span>
                                <span class="more-detail-title">
                                        Почтовый/банковский перевод
                                    </span>
                            </p>
                            <p>
                                    <span>
                                        Способ доставки:
                                    </span>
                                <span class="more-detail-title">
                                        Самовывоз из Новой Почты
                                    </span>
                            </p>
                            <p>
                                    <span>
                                        Покупатель:
                                    </span>
                                <span class="more-detail-title">
                                        Евгений Конорев
                                    </span>
                            </p>
                            <p>
                                    <span>
                                        Телефон:
                                    </span>
                                <span class="more-detail-title">
                                        +380 (99) 951-51-24
                                    </span>
                            </p>
                            <p>
                                    <span>
                                        Адрес пункта самовывоза:
                                    </span>
                                <span class="more-detail-title">
                                        Константиновка Донецкая обл., Отделение №2, пл. Победы, д. 16
                                    </span>
                            </p>
                            <p>
                                    <span>
                                       E-mail:
                                    </span>
                                <span class="more-detail-title">
                                        konarev93@gmail.com
                                    </span>
                            </p>
                            <p>
                                    <span>
                                       Номер ТТН:
                                    </span>
                                <span class="more-detail-title">
                                        <strong>
                                            20400004295107
                                        </strong>
                                    </span>
                            </p>
                        </div>
                    </div>
                    <div class="basket-table">
                        <div class="basket-row clearfix">
                            <div class="description left">
                                <div class="image left">
                                    <img src="/img/item2.png" alt="">
                                </div>
                                <div class="description-text left">
                                    <p class="description-name">
                                        Бэтмен. Книга 2. Город Сов
                                    </p>
                                    <p class="description-code">
                                        Код товара: MPZ036
                                    </p>
                                </div>
                            </div>
                            <div class="info-description right">
                                <div class="total-count right">
                                    <p class="info-title">
                                        Сумма:
                                    </p>
                                    <p>
                                        250 грн
                                    </p>
                                </div>
                                <div class="price right">
                                    <p class="info-title">
                                        Цена:
                                    </p>
                                    <p>
                                        250 грн
                                    </p>
                                </div>
                                <div class="counter right">
                                    <p class="info-title">
                                        Кол-во:
                                    </p>
                                    <p>
                                        1шт
                                    </p>
                                </div>



                            </div>
                        </div>
                        <div class="basket-row clearfix">
                            <div class="description left">
                                <div class="image left">
                                    <img src="/img/item2.png" alt="">
                                </div>
                                <div class="description-text left">
                                    <p class="description-name">
                                        Бэтмен. Книга 2. Город Сов
                                    </p>
                                    <p class="description-code">
                                        Код товара: MPZ036
                                    </p>
                                </div>
                            </div>
                            <div class="info-description right">
                                <div class="total-count right">
                                    <p class="info-title">
                                        Сумма:
                                    </p>
                                    <p>
                                        250 грн
                                    </p>
                                </div>
                                <div class="price right">
                                    <p class="info-title">
                                        Цена:
                                    </p>
                                    <p>
                                        250 грн
                                    </p>
                                </div>
                                <div class="counter right">
                                    <p class="info-title">
                                        Кол-во:
                                    </p>
                                    <p>
                                        1шт
                                    </p>
                                </div>



                            </div>
                        </div>
                    </div>
                    <div class="payment-status clearfix">
                        <p>
                            Всего к оплате
                            <strong>
                                500 грн.
                            </strong>
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
