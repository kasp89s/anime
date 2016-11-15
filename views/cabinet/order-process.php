<?php
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\helpers\Html;

$priceWithoutDiscounts = 0;
$totalDiscount = 0;
$totalIncrease = 0;
?>

<div class="content-container clearfix">
    <div class="ordering-block">
        <h3 class="order-title">
            Оформление заказа
        </h3>
        <div class="order-info-block clearfix">
            <div class="order-info left">
                <div class="order-info-row">
                    <p class="number-title">
                                <span class="number">
                                    1
                                </span>
                        Контактные данные
                    </p>
                    <div class="form-row clearfix">
                        <p class="label-info left">
                            Имя Фамилия
                        </p>
                        <input type="text" class="order-input">
                    </div>
                    <div class="form-row clearfix">
                        <p class="label-info left">
                            Моб. телефон
                        </p>
                        <input type="text" class="order-input">
                    </div>
                </div>
                <div class="order-info-row">
                    <p class="number-title">
                                <span class="number">
                                    2
                                </span>
                        Выбор способов доставки и оплаты
                    </p>
                    <div class="form-row clearfix">
                        <p class="label-info left">
                            Адрес
                        </p>
                        <input type="text" class="order-input">
                    </div>
                </div>
                <div class="order-info-row">
                    <div class="form-row clearfix">
                        <p class="label-info left">
                            Доставка
                        </p>
                        <div class="delivery-block left">
                            <div class="delivery-type">
                                <label class="form-label">
                                    <input name="radio"  class="no-courier" type="radio" checked="checked">
                                    <span class="label-text">Самовывоз</span>
                                </label>
                            </div>
                            <div class="delivery-type">
                                <label class="form-label">
                                    <input name="radio" class="courier" type="radio">
                                    <span class="label-text">Курьером</span>
                                </label>
                            </div>
                            <div class="delivery-info">
                                <p class="label-info left">
                                    Имя Фамилия
                                </p>
                                <input type="text" class="order-input">
                                <p class="delivery-price">
                                    * Доставка курьром: + 30 грн к стоимости заказа.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="order-info-row">
                    <div class="form-row clearfix">
                        <p class="label-info left">
                            Оплата
                        </p>
                        <div class="payment-type left">
                            <div>
                                <label class="form-label">
                                    <input name="radio3"type="radio">
                                    <span class="label-text">Наличными</span>
                                </label>
                            </div>
                            <div>
                                <label class="form-label">
                                    <input name="radio3"type="radio">
                                    <span class="label-text">Предоплата</span>
                                </label>
                            </div>
                            <div>
                                <label class="form-label">
                                    <input name="radio3"type="radio">
                                    <span class="label-text">Наложенный платеж</span>
                                </label>
                            </div>
                            <div>
                                <label class="form-label">
                                    <input name="radio3"type="radio">
                                    <span class="label-text">Visa/MasterCard</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="order-info-row">
                    <button class="add-order-comment">
                        Добавить комментарий к заказу
                    </button>
                    <textarea class="order-comment"></textarea>
                </div>
            </div>
            <div class="total-info right">
                <h5 class="total-info-title">
                    Вы заказали:
                </h5>
                <?php if (!empty($this->params['basket']->basketProducts)):?>
                <div class="row-item-list">
                    <?php foreach ($this->params['basket']->basketProducts as $basketProduct):?>
                    <?php
                        $increasePriceByAttributes = 0;
                    ?>
                    <div class="total-info-row">
                        <div class="item-title">
                            <?php echo $basketProduct->product->name?>
                        </div>
                        <?php if (!empty($basketProduct->productAttributes)):?>
                            <?php foreach ($basketProduct->productAttributes as $basketProductAttribute):?>
                                <?= $basketProductAttribute->productOption->name?>: <?= $basketProductAttribute->productOptionValue->name?> <br />
                                <?php $increasePriceByAttributes+= (int) $basketProductAttribute->productOptionValue->price;?>
                            <?php endforeach;?>
                        <?php endif;?>
                        <div class="row-item-info clearfix">
                            <div class="left">
                                Кол-во: <?php echo $basketProduct->quantity?> шт.
                            </div>
                            <div class="right">
                                Цена: <?= number_format(($basketProduct->product->realPrice + $increasePriceByAttributes), 0, '', ' ')?>
                                <?php echo $basketProduct->product->currencyCode?>.
                                <?php $priceWithoutDiscounts+= $basketProduct->product->realPrice + $increasePriceByAttributes;?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
                <?php endif;?>
                <div class="total-bill">
                    <div class="total-info-row-sum calc-row">
                        <h5>

                        </h5>
                        <div class="row-item-info clearfix">
                            <div class="left">
                                <?= count($this->params['basket']->basketProducts)?> товара на сумму:
                            </div>
                            <div class="right">
                                <?= $priceWithoutDiscounts?> грн.
                            </div>
                        </div>
                        <?php if (!empty($this->params['user'])):?>
                        <div class="row-item-info clearfix">
                            <div class="left">
                                Накопительная скидка:
                            </div>
                            <div class="right">
                                -<?= $totalDiscount+= $this->params['user']->getDiscountByOrderAmount($priceWithoutDiscounts)?> грн.
                            </div>
                        </div>
                        <?php endif;?>
                        <?php if (!empty($promoCode)):?>
                        <div class="row-item-info clearfix">
                            <div class="left">
                                Скидка по промокоду:
                            </div>
                            <div class="right">
                                -<?= $totalDiscount+= $promoCode->getDiscountByAmount($priceWithoutDiscounts)?> грн.
                            </div>
                        </div>
                        <?php endif;?>
                        <!--
                        <div class="row-item-info clearfix">
                            <div class="left">
                                Комиссия оплаты:
                            </div>
                            <div class="right">
                                5 грн.
                            </div>
                        </div>
                        -->
                        <!--
                        <div class="row-item-info clearfix">
                            <div class="left">
                                Доставка:
                            </div>
                            <div class="right">
                                —
                            </div>
                        </div>
                        -->
                    </div>
                    <div class="total-info-row-sum">
                        <div class="row-item-info clearfix">
                            <div class="summary-price-title left">
                                Кол-во: <?= count($this->params['basket']->basketProducts)?> шт.
                            </div>
                            <div class="summary-price right">
                                Цена: <?= $priceWithoutDiscounts - $totalDiscount?> грн.
                            </div>
                        </div>
                        <div class="control-order clearfix">
                            <button class="done-order left" onclick="window.location.href='<?= Url::to('/cabinet/order-complete')?>'">
                                Заказ подтверждаю
                            </button>
                            <button class="edit-order right" onclick="window.location.href='<?= Url::to('/cabinet/basket')?>'">
                                редактировать заказ
                            </button>
                        </div>
                        <div class="promo-block">
                            <button class="enter-promo">
                                Ввести пропокод
                            </button>
                            <input class="promo-field" placeholder="Промокод" type="text">
                        </div>
                        <button class="make-order" style="display: none;">
                            подтвердить
                        </button>
                    </div>

                </div>

            </div>

        </div>
    </div>

</div>