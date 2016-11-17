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
                                Заказ #<?= $order->id?> от <?= \app\models\Order::getDate($order->createTime)?>
                            </span>
                        <a href="javascript:void(0)" class="print right">
                            распечатать чек
                        </a>
                    </div>
                </div>
                <div class="order-info-row">
                    <div class="enter-info">
                        Имя Фамилия: <span><?= $order->customerInfo->fullName?></span>
                    </div>
                    <div class="enter-info">
                        Моб. телефон: <span><?= $order->customerInfo->phone1?></span>
                    </div>
                </div>
                <div class="order-info-row">

                    <div class="enter-info">
                        Адресс: <span><?= $order->customerInfo->address?></span>
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
                                <span><?= $order->shipping->name?></span>
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
                                <span><?= $order->payment->name?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="order-info-row">
                    <div class="order-phone">
                        <p>
                            По вопросам заказов обращайтесь по телефону:
                        </p>
                        <strong><?= \Yii::$app->params['phone']?></strong>
                    </div>
                </div>

            </div>
            <div class="total-info right">
                <h5 class="total-info-title">
                    Вы заказали:
                </h5>
                <div class="row-item-list">
                    <?php foreach ($order->products as $product):?>
                    <div class="total-info-row">
                        <div class="item-title">
                            <?= $product->productName?>
                        </div>
                        <div class="row-item-info clearfix">
                            <div class="left">
                                Кол-во: <?= $product->productQuantity?> шт.
                                <?php if (!empty($product->productAttributes)):?>
                                    <?php foreach ($product->productAttributes as $orderProductAttribute):?>
                                        <?= $orderProductAttribute->option->name?>: <?= $orderProductAttribute->optionValue->name?> <br />
                                    <?php endforeach;?>
                                <?php endif;?>
                            </div>
                            <div class="right">
                                Цена: <?= $product->productPrice * $product->productQuantity?> <?= $product->currencyCode?>.
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>

                <div class="total-bill">
                    <div class="total-info-row-sum">
                        <div class="row-item-info clearfix">
                            <div class="summary-price-title left">
                                Кол-во: <?= count($order->products)?> шт.
                            </div>
                            <div class="summary-price right">
                                Цена: <?= $order->total->amount?>  <?= $order->total->currencyCode?>.
                            </div>
                        </div>
                        <a href="/" class="continue">
                            Продолжить покупки
                        </a>
                    </div>

                </div>

            </div>

        </div>
    </div>

</div>