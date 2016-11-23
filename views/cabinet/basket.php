<?php
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\helpers\Html;

$totalAmount = 0;
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
            Корзина
        </h3>
        <?php if (!empty($this->params['basket']->basketProducts)):?>
        <div class="basket-table">
            <?php foreach ($this->params['basket']->basketProducts as $basketProduct):?>

            <?php
                $increasePriceByAttributes = 0;
            ?>
            <div class="basket-row clear">
                <div class="description left">
                    <div class="image left">
                        <?= Html::img('/uploads/product/' . $basketProduct->product->id .'/' . $basketProduct->product->imageFileName, []);?>
                    </div>
                    <div class="description-text left">
                        <p class="description-name">
                            <?php echo $basketProduct->product->name?>
                        </p>
                        <?php if (!empty($basketProduct->productAttributes)):?>
                            <p class="description-size">
                                <?php foreach ($basketProduct->productAttributes as $basketProductAttribute):?>
                                    <?= $basketProductAttribute->productOption->name?>: <?= $basketProductAttribute->productOptionValue->name?> <br />
                                    <?php $increasePriceByAttributes+= (int) $basketProductAttribute->productOptionValue->price;?>
                                <?php endforeach;?>
                            </p>
                        <?php endif;?>
                        <p class="description-code">
                            Код товара: <?php echo $basketProduct->product->sku?>
                        </p>
                    </div>
                </div>
                <div class="info-description right">
                    <div class="remove-button right">
                        <button class="remove-button-item">
                            <img src="/img/remove-button.png" alt="">
                        </button>
                    </div>
                    <div class="price right">
                        <p class="info-title">
                            Сумма:
                        </p>
                        <p>
                            <?= number_format(($basketProduct->product->realPrice + $increasePriceByAttributes) * $basketProduct->quantity, 0, '', ' ')?> <?php echo $basketProduct->product->currencyCode?>
                            <?php $totalAmount+= ($basketProduct->product->realPrice + $increasePriceByAttributes) * $basketProduct->quantity;?>
                        </p>
                    </div>
                    <div class="total-count right">
                        <p class="info-title">
                            Стоимость:
                        </p>
                        <p>
                            <?= number_format(($basketProduct->product->realPrice + $increasePriceByAttributes), 0, '', ' ')?> <?php echo $basketProduct->product->currencyCode?>
                        </p>
                    </div>
                    <div class="counter right">
                        <p class="info-title">
                            Кол-во:
                        </p>
                        <div class="counter-block left">
                            <div class="left">
                                <input type="text" class="basket-product-quantity" data-id="<?= $basketProduct->id?>" value="<?= $basketProduct->quantity?>" />
                            </div>
                            <div class="right">
                                <button class="plus" data-value="1"></button>
                                <button class="minus"  data-value="-1"></button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        </div>
        <?php endif;?>
        <div class="payment-info clear">
            <?php if (\Yii::$app->session->get('user') && !empty(\Yii::$app->session->get('user')->group->isActive)):?>
            <div class="discount left">
                <p>
                    Ваша накопительная скидка составляет: <?= round(\Yii::$app->session->get('user')->group->groupDiscount)?>%
                </p>
            </div>
            <?php endif;?>
            <div class="payment right">
                        <span>
                            Всего к оплате: <strong><?= number_format($totalAmount, 0, '', ' ')?> грн.</strong>
                        </span>
                <button onclick="window.location.href='<?= Url::to('/cabinet/order-process')?>'">
                    ОФОРМИТЬ ЗАКАЗ
                </button>
            </div>
        </div>

    </div>
</div>
