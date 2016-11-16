<?php
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

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
                <?php $form = ActiveForm::begin([
                        'action' => '/cabinet/order-complete',
                        'enableAjaxValidation' => true,
                        'options'=>['class'=>'row'],
                        'fieldConfig' => [
                            'template' => '{label}{input}{error}',
                            'errorOptions' => ['class' => 'error text-danger'],
                            'labelOptions' => ['class' => 'label-info left'],
                            'inputOptions' => ['class' => 'order-input'],
                            'options' => [
                                'tag' => 'div',
                                'class' => 'form-row clearfix',
                            ],
                        ],
                    ]); ?>
                <?//= Html::input('hidden', 'totalAmount', null);?>
                <div class="order-info-row">
                    <p class="number-title">
                                <span class="number">
                                    1
                                </span>
                        Контактные данные
                    </p>

                    <?= $form->field($orderForm, 'fullName')->textInput(['value' => $this->params['user']->address->fullName]) ?>

                    <?= $form->field($orderForm, 'phone')->textInput(['value' => $this->params['user']->address->phone1]) ?>
                </div>
                <div class="order-info-row">
                    <p class="number-title">
                                <span class="number">
                                    2
                                </span>
                        Выбор способов доставки и оплаты
                    </p>
                    <?= $form->field($orderForm, 'address')->textInput(['value' => $this->params['user']->address->address]) ?>
                </div>
                <div class="order-info-row">
                    <div class="form-row clearfix">
                        <p class="label-info left">
                            <?= Html::activeLabel($orderForm, 'shipping') ?>
                        </p>
                        <?php if (!empty($shippingMethods)):?>
                        <div class="delivery-block left">
                            <?php foreach ($shippingMethods as $key => $method):?>
                            <div class="delivery-type">
                                <label class="form-label">
                                    <input
                                        name="OrderProcessForm[shipping]"
                                        class="no-courier"
                                        type="radio"
                                        value="<?= $method->id?>"
                                        data-price-value="<?= round($method->price)?>"
                                        data-insurance-value="<?= round($method->insurancePercent)?>"
                                        data-price-message="<?= ($method->price > 0) ? '* Доставка ' . $method->name . ': + ' . round($method->price). ' грн к стоимости заказа.' : ''?>"
                                        data-insurance-message="<?= ($method->insurancePercent > 0) ? '* Доставка ' . $method->name . ': + ' . round($method->insurancePercent) . '% к стоимости заказа.' : ''?>"
                                        <?= ($key == 0) ? 'checked' : ''?>
                                    />
                                    <span class="label-text"><?= $method->name?></span>
                                </label>
                            </div>
                            <?php endforeach;?>
                            <div class="delivery-info">
                                    <p class="delivery-price"></p>
                            </div>
                            <?= Html::error($orderForm, 'shipping', ['class' => 'error text-danger', 'id' => 'orderprocessform-shipping']) ?>
                            <div class="error text-danger"></div>
                        </div>
                        <?php endif;?>
                    </div>
                </div>
                <div class="order-info-row">
                    <?php if (!empty($paymentMethods)):?>
                    <div class="form-row clearfix">
                        <p class="label-info left">
                            <?= Html::activeLabel($orderForm, 'payment') ?>
                        </p>
                        <div class="payment-type left">
                            <?php foreach ($paymentMethods as $key => $method):?>
                            <div>
                                <label class="form-label">
                                    <input
                                        name="OrderProcessForm[payment]"
                                        data-price="<?= round($method->price)?>"
                                        data-fee="<?= round($method->feePercent)?>"
                                        type="radio" <?= ($key == 0) ? 'checked' : ''?>
                                        value="<?= $method->id?>"
                                    />
                                    <span class="label-text">
                                        <?= $method->name?>
                                        <?php if ($method->price > 0):?>
                                            + <?= $method->price?> грн к стоимости заказа.
                                        <?php endif;?>
                                        <?php if ($method->feePercent > 0):?>
                                            + <?= $method->feePercent?>% к стоимости заказа.
                                        <?php endif;?>
                                    </span>
                                </label>
                            </div>
                            <?php endforeach;?>
                            <?= Html::error($orderForm, 'payment', ['class' => 'error text-danger', 'id' => 'orderprocessform-payment']) ?>
                            <div class="error text-danger"></div>
                        </div>
                    </div>
                    <?php endif;?>
                </div>
                <div class="order-info-row">
                    <button class="add-order-comment">
                        <?= Html::activeLabel($orderForm, 'comment') ?>
                    </button>
                    <?= Html::activeTextarea($orderForm, 'comment', ['class' => 'order-comment']) ?>
                </div>
                <?php ActiveForm::end(); ?>
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
                        <div class="row-item-info clearfix">
                            <div class="left">
                                Комиссия оплаты:
                            </div>
                            <div class="right payment-commission">—</div>
                        </div>
                        <div class="row-item-info clearfix">
                            <div class="left">
                                Доставка:
                            </div>
                            <div class="right delivery-commission">—</div>
                        </div>
                    </div>
                    <div class="total-info-row-sum">
                        <div class="row-item-info clearfix">
                            <div class="summary-price-title left">
                                Кол-во: <?= count($this->params['basket']->basketProducts)?> шт.
                            </div>
                            <div class="summary-price right">
                                Цена: <span class="totalAmount"><?= $priceWithoutDiscounts - $totalDiscount?></span> грн.
                            </div>
                        </div>
                        <div class="control-order clearfix">
                            <button class="done-order left">
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
