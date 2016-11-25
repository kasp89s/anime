<?php
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\CommentWidget;
?>
<div class="breadcrumbs-block clearfix">
    <ul>
        <?php echo Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], 'homeLink' => false]);?>
    </ul>
</div>
<div class="content-container clearfix">
    <div class="product-row clearfix">
        <?php if ($product->images):?>
        <div class="main-product-slider left">
            <div class="nav-big-slider left">
                <?php foreach ($product->images as $image):?>
                    <div class="item">
                        <?= Html::img('/uploads/product/' . $product->id .'/' . $image->imageFileName, []);?>
                    </div>
                <?php endforeach;?>
            </div>
            <div class="big-slider-product left">
                <?php foreach ($product->images as $image):?>
                    <div class="item">
                        <?= Html::img('/uploads/product/' . $product->id .'/' . $image->imageFileName, []);?>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
        <?php endif;?>
        <div class="main-product-description left">
            <div class="about-product left">
                <p class="about-product-title">
                    <?php echo $product->name?>
                </p>
                <p class="about-product-code">
                    Код товара: <?php echo $product->sku?>
                </p>
                <p class="product-price-info">
                    <span class="product-price-field" data-value="<?php echo $product->realPrice?>">
                        <?php echo $product->realPrice?>
                    </span>
                    <?php echo $product->currencyCode?>.
                    <?php if ($product->quantityInStock > 0):?>
                        <span>В наличии <?php echo $product->quantityInStock?> шт. </span>
                    <?php else:?>
                        <span>Нет в наличии. </span>
                    <?php endif;?>
                </p>
                <button class="add-product" data-id="<?php echo $product->id?>">
                    Добавить в корзину
                </button>
                <br />
                <button class="enter-modal-btn quick-button">
                    Заказать в один клик
                </button>
                <div class="rating-info">
                    <?php if (!empty($this->params['user']->id)):?>
                    <button class="add-wish<?= ($isWish) ? ' active' : ''?>" data-id="<?php echo $product->id?>">
                        в избранное
                    </button>
                    <?php endif;?>
                    <ul class="rating">
                        <?= str_repeat('<li class="active"></li>', $product->commentsRate)?><?= str_repeat('<li></li>', 5 - $product->commentsRate)?>
                    </ul>
                    <span>
                        <?= count($product->comments)?>
                        <?php echo \Yii::numberEnd(count($product->comments), 'отзыв', ['', 'а', 'ов']);?>
                    </span>
                </div>
                <?= Html::beginForm('', 'post', ['id' => 'option-form']); ?>
                <?= Html::input('hidden', 'productId', $product->id);?>
                <ul class="description-list">
                    <?php if(!empty($product->productAttributes)):?>
                        <?php foreach ($product->formattedAttributes as $optionId => $optionData):?>
                        <li>
                            <span class="size-title">
                                <?= $optionData['name']?>:
                            </span>
                            <div class="size">
                                <?php foreach ($optionData['values'] as $optionValueId => $optionValue):?>
                                    <div>
                                        <input type="radio" name="option[<?= $optionId?>]" data-price="<?= $optionValue['price']?>" value="<?= $optionValueId?>" class="attribute-checked">
                                        <?= $optionValue['name']?>
                                    </div>
                                <?php endforeach;?>
                            </div>
                        </li>
                        <?php endforeach;?>
                    <?php endif;?>

                    <?php if (!empty($product->specificationRelations)):?>
                        <?php foreach ($product->specificationRelations as $relation):?>
                            <li>
                                <?php if ($relation->isSearch):?>
                                    <?= $relation->specification->name?>: <a href="<?= Url::to('/specification?id=' . $relation->specification->id . '&value=' . $relation->value)?>"><?= $relation->value?></a>
                                <?php else:?>
                                    <?= $relation->specification->name?>: <span><?= $relation->value?></span>
                                <?php endif;?>
                            </li>
                         <?php endforeach;?>
                    <?php endif;?>
                </ul>
                <?= Html::endForm();?>
                <div class="horizontal-share">
                    <img src="/img/horizonyal-share.png" alt="">
                </div>
            </div>

            <div class="product-delivery left">
                <?php if (!empty($shippingMethods)):?>
                <p>
                    <?php foreach ($shippingMethods as $method):?>
                        <span><?= $method->name?> - <?= ($method->price) ? round($method->price) . ' ' . $method->countryCode : 'бесплатно'?></span><br>
                    <?php endforeach;?>
                </p>
                <?php endif;?>
                <p>
                    <span>«Транспортные компании»</span>
                    - Стоимость доставки расчитывается по тарифам транспортной компании.
                    Расчёт идёт при получении заказа в отделении транспортной компании.
                </p>
                <p>
                    <a href="<?= Url::to('/page/'. $this->params['pages']['delivery']->code)?>">
                        Читать подробнее...
                    </a>
                </p>
                <?php if (!empty($paymentMethods)):?>
                <ul class="product-payment">
                    <?php foreach ($paymentMethods as $method):?>
                    <li>
                        <?= Html::img('/uploads/paymentMethod/' . $method->id .'/' . $method->imageFileName)?>
                    </li>
                    <?php endforeach;?>
                </ul>
                <?php endif;?>
            </div>
        </div>
    </div>
    <div class="product-row description-row">
        <h4>
            Описание: <span><?php echo $product->name?> (<?php echo $product->sku?>)</span>
        </h4>
        <?php echo $product->description?>
    </div>
    <div class="product-row clearfix">
        <?= CommentWidget::widget(['model' => $product]) ?>
    </div>
    <?php if (!empty($viewProductList)):?>
    <div class="product-row">
        <div class="last-view clearfix">
            <h4 class="left">
                Последние просмотренные товары
            </h4>
            <div class="show-all-last right">
                <a href="<?= Url::to('/cabinet/viewed')?>">
                    Показать все
                </a>
            </div>
        </div>
        <?= \app\components\LastViewWidget::widget(['models' => $viewProductList]) ?>
    </div>
    <?php endif;?>
</div>

<div id="overlay" style="display: none;"></div>
<div class="modal enter-modal" style="opacity: 0; top: 45%; display: none;">

    <div class="build-in-popup" id="recover-password">

        <div class="close right">
            <img src="/img/remove-button.png" alt="">
        </div>

        <h2>Быстрый заказ</h2>
        <div class="table">
            <?php $form = ActiveForm::begin([
                'action' => '/cabinet/quick-order',
                'enableAjaxValidation' => true,
                'options'=>['class'=>'row'],
                'fieldConfig' => [
                    'template' => '{label}{input}{error}',
                    'errorOptions' => ['class' => 'error text-danger'],
                    'labelOptions' => ['class' => ''],
                    'inputOptions' => ['class' => 'input'],
                    'options' => [
                        'tag' => 'div',
                    ],
                ],
            ]); ?>

                <?= $form->field($quickOrder, 'productId')->hiddenInput(['value' => $product->id])->label(false) ?>

                <?= $form->field($quickOrder, 'name') ?>

                <?= $form->field($quickOrder, 'phone') ?>

                <div class="enter-row">
                    <?= Html::submitButton('Заказать', ['class' => 'button submit']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>