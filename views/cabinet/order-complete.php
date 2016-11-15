<?php
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\helpers\Html;
?>

<div class="content-container clearfix">
    <div class="ordering-block">
        <h3 class="order-title">
            Cпасибо за ваш заказ!
        </h3>
        <p class="order-subtitle">
            Сообщение о подтверждении заказа  было выслано на ваш e-mail.
        </p>
        <div class="order-info-block clearfix">
            <div class="order-info left">
                <div class="order-info-row">
                    <p class="title">
                        Информация о Вашем заказе:
                    </p>
                    <div class="order-number clearfix">
                            <span class="left">
                                Заказ #1805391 от 19 марта 2016 г.
                            </span>
                        <a href="#" class="print right">
                            распечатать чек
                        </a>
                    </div>
                </div>
                <div class="order-info-row">
                    <div class="enter-info">
                        Имя Фамилия: <span>Евгений Конорев</span>
                    </div>
                    <div class="enter-info">
                        Моб. телефон: <span>+380 (99) 123-23-32</span>
                    </div>
                </div>
                <div class="order-info-row">
                    <div class="enter-info">
                        Город: <span>Киев, Киевская область</span>
                    </div>
                </div>
                <div class="order-info-row">

                    <div class="enter-info">
                        Город: <span>Киев, Киевская область</span>
                    </div>
                    <div class="enter-info">
                        <div class="more-info-title">
                            Доставка:
                        </div>
                        <div class="more-info">
                            <div class="radio-button">
                                <label class="form-label">
                                    <input name="radio" type="radio" checked="checked">
                                    <span class="label-text"></span>
                                </label>
                                <span>
                                            Курьером
                                        </span>
                            </div>
                            <div>
                                ул. Пушкина, д 221Б, квартира 2
                            </div>
                        </div>
                    </div>
                    <div class="enter-info">
                        <div class="more-info-title">
                            Оплата:
                        </div>
                        <div class="more-info">
                            <div class="radio-button">
                                <label class="form-label">
                                    <input name="radio2" type="radio" checked="checked">
                                    <span class="label-text"></span>
                                </label>
                                <span>
                                            Наличными
                                        </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="order-info-row">
                    <div class="order-phone">
                        <p>
                            По вопросам заказов обращайтесь по телефону:
                        </p>
                        <strong>
                            +380 (93) 716–54–65
                        </strong>
                    </div>
                </div>

            </div>
            <div class="total-info right">
                <h5 class="total-info-title">
                    Вы заказали:
                </h5>
                <div class="row-item-list">
                    <div class="total-info-row">
                        <div class="item-title">
                            Боун. Книга 1. Изгнанники Боунвилля
                        </div>
                        <div class="row-item-info clearfix">
                            <div class="left">
                                Кол-во: 1 шт.
                            </div>
                            <div class="right">
                                Цена: 260 грн.
                            </div>
                        </div>
                    </div>
                    <div class="total-info-row">
                        <div class="item-title">
                            Боун. Книга 2. Великие коровьи бега
                        </div>
                        <div class="row-item-info clearfix">
                            <div class="left">
                                Кол-во: 1 шт.
                            </div>
                            <div class="right">
                                Цена: 260 грн.
                            </div>
                        </div>
                    </div>
                    <div class="total-info-row">
                        <div class="item-title">
                            All You Need Is Kill. Грань будущего. Книга 1
                        </div>
                        <div class="row-item-info clearfix">
                            <div class="left">
                                Кол-во: 1 шт.
                            </div>
                            <div class="right">
                                Цена: 260 грн.
                            </div>
                        </div>
                    </div>
                    <div class="total-info-row">
                        <div class="item-title">
                            All You Need Is Kill. Грань будущего. Книга 2
                        </div>
                        <div class="row-item-info clearfix">
                            <div class="left">
                                Кол-во: 1 шт.
                            </div>
                            <div class="right">
                                Цена: 160 грн.
                            </div>
                        </div>
                    </div>
                    <div class="total-info-row">
                        <div class="item-title">
                            All You Need Is Kill. Грань будущего. Книга 2
                        </div>
                        <div class="row-item-info clearfix">
                            <div class="left">
                                Кол-во: 1 шт.
                            </div>
                            <div class="right">
                                Цена: 160 грн.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="total-bill">
                    <div class="total-info-row-sum">
                        <div class="row-item-info clearfix">
                            <div class="summary-price-title left">
                                Кол-во: 1 шт.
                            </div>
                            <div class="summary-price right">
                                Цена: 160 грн.
                            </div>
                        </div>
                        <a href="#" class="continue">
                            Продолжить покупки
                        </a>
                    </div>

                </div>

            </div>

        </div>
    </div>

</div>