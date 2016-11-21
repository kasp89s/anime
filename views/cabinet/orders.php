<?php
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\helpers\Html;
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
            <?php if (!empty($orders)):?>
            <div class="order-list">
                <?php foreach ($orders as $order):?>
                <div class="order-block">
                    <div class="order-info clearfix">
                        <div class="order-number left">
                                <span>
                                    Заказ <strong>#<?= $order->id?></strong> от <?= \app\models\Order::getDate($order->createTime)?>
                                </span>
                            <span class="detail-button">
                                    Детали заказа
                                </span>
                        </div>
                        <div class="order-status right">
                                <span>
                                    Статус заказа:
                                </span>
                            <span class="done"><?= $order->status->name?></span>
                        </div>

                        <div class="more-detail clearfix">
                            <p>
                                    <span>
                                        Способ оплаты:
                                    </span>
                                <span class="more-detail-title"><?= $order->payment->name?></span>
                            </p>
                            <p>
                                    <span>
                                        Способ доставки:
                                    </span>
                                <span class="more-detail-title"><?= $order->shipping->name?></span>
                            </p>
                            <p>
                                    <span>
                                        Покупатель:
                                    </span>
                                <span class="more-detail-title"><?= $order->customerInfo->fullName?></span>
                            </p>
                            <p>
                                    <span>
                                        Телефон:
                                    </span>
                                <span class="more-detail-title"><?= $order->customerInfo->phone1?></span>
                            </p>
<!--                            <p>-->
<!--                                    <span>-->
<!--                                        Адрес пункта самовывоза:-->
<!--                                    </span>-->
<!--                                <span class="more-detail-title">-->
<!--                                        Константиновка Донецкая обл., Отделение №2, пл. Победы, д. 16-->
<!--                                    </span>-->
<!--                            </p>-->
                            <p>
                                    <span>
                                       E-mail:
                                    </span>
                                <span class="more-detail-title">
                                        <?= $order->customer->email?>
                                    </span>
                            </p>
                            <?php if (!empty($order->postBarcode) && !empty($order->postBarcode->isAvailable)):?>
                            <p>
                                    <span>
                                       Номер ТТН:
                                    </span>
                                <span class="more-detail-title">
                                        <strong>
                                            <?= $order->postBarcode->barcode?>
                                        </strong>
                                    </span>
                            </p>
                            <?php endif;?>
                        </div>
                    </div>
                    <div class="basket-table">
                        <?php foreach ($order->products as $product):?>
                        <div class="basket-row clearfix">
                            <div class="description left">
                                <div class="image left">
                                    <?= Html::img('/uploads/product/' . $product->product->id .'/' . $product->product->imageFileName, []);?>
                                </div>
                                <div class="description-text left">
                                    <p class="description-name">
                                        <?= $product->productName?>
                                        <?php if (!empty($product->productAttributes)):?>
                                            <?php foreach ($product->productAttributes as $attribute):?>
                                                <br /><?= $attribute->productOptionName?>: <?= $attribute->productOptionValueName?>
                                            <?php endforeach;?>
                                        <?php endif;?>
                                    </p>
                                    <p class="description-code">
                                        Код товара: <?= $product->productSku?>
                                    </p>
                                </div>
                            </div>
                            <div class="info-description right">
                                <div class="total-count right">
                                    <p class="info-title">
                                        Сумма:
                                    </p>
                                    <p>
                                        <?= $product->productPrice * $product->productQuantity?> <?= $product->currencyCode ?>
                                    </p>
                                </div>
                                <div class="price right">
                                    <p class="info-title">
                                        Цена:
                                    </p>
                                    <p>
                                        <?= $product->productPrice ?> <?= $product->currencyCode ?>
                                    </p>
                                </div>
                                <div class="counter right">
                                    <p class="info-title">
                                        Кол-во:
                                    </p>
                                    <p>
                                        <?= $product->productQuantity ?>шт
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                    </div>
                    <div class="payment-status clearfix">
                        <p>
                            Всего к оплате
                            <strong>
                                <?= $order->total->amount?> <?= $order->total->currencyCode?>.
                            </strong>
                        </p>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
            <?php endif;?>
        </div>
    </div>
