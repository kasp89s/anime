<?php
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\CommentWidget;

$waitForm = new \app\models\WaitForm();
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
                <?php if($product->quantityInStock > 0):?>
                <button class="add-product" data-id="<?php echo $product->id?>">
                    Добавить в корзину
                </button>
                <br />
                <button class="enter-modal-btn quick-button">
                    Заказать в один клик
                </button>
                <?php else:?>
                    <a
                        href="javascript:void(0)"
                        data-product="<?= $product->id?>"
                        data-user="<?= (!empty($this->params['user'])) ? $this->params['user']->id : ''?>"
                        class="quick-button wait-modal-btn">Уведомить о наличии</a>
                <?php endif;?>
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
                                        <?php if ($optionValue['price'] > 0):?>+ (<?= $optionValue['price']?> <?php echo $product->currencyCode?>.)<?php endif;?>
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
                                    <?= $relation->specification->name?>: <a href="<?= Url::to('/specification/' . $relation->id)?>"><?= $relation->value?></a>
                                <?php else:?>
                                    <?= $relation->specification->name?>: <span><?= $relation->value?></span>
                                <?php endif;?>
                            </li>
                         <?php endforeach;?>
                    <?php endif;?>
                </ul>
                <?= Html::endForm();?>
                <div class="horizontal-share">
                    <a rel="nofollow"  title="ВКонтакте" class="b-share__handle b-share__link b-share-btn__vkontakte"
                        href="http://vk.com/share.php?url=http://<?= Yii::$app->getRequest()->serverName?>/product/<?= $product->id?>&title=<?= urlencode($product->name)?>&description=<?= urlencode($product->description)?>&image=<?= 'http://' . Yii::$app->getRequest()->serverName . '/uploads/product/' . $product->id .'/' . $product->images[0]->imageFileName;?>"
                        onclick="window.open(this.href, 'mywin', 'left=20,top=20,width=600,height=500,toolbar=1,resizable=0'); return false;"><span class="b-share-icon b-share-icon_vkontakte"></span></a>
                    <a rel="nofollow" target="_blank" title="Facebook" class="b-share__handle b-share__link b-share-btn__facebook"
                        href="https://www.facebook.com/sharer/sharer.php?sdk=joey&u=http://<?= Yii::$app->getRequest()->serverName?>/product/<?= $product->id?>&title=<?= urlencode($product->name)?>&description=<?= urlencode(strip_tags($product->description))?>&image=<?= 'http://' . Yii::$app->getRequest()->serverName . '/uploads/product/' . $product->id .'/' . $product->images[0]->imageFileName;?>"
                       onclick="window.open(this.href, 'mywin', 'left=20,top=20,width=600,height=500,toolbar=1,resizable=0'); return false;"><span class="b-share-icon b-share-icon_facebook"></span></a>
                    <a rel="nofollow" target="_blank" title="Twitter" class="b-share__handle b-share__link b-share-btn__twitter"
                        href="https://twitter.com/home?status=<?= urlencode($product->name)?> http://<?= Yii::$app->getRequest()->serverName?>/product/<?= $product->id?>"
                       onclick="window.open(this.href, 'mywin', 'left=20,top=20,width=600,height=500,toolbar=1,resizable=0'); return false;"><span class="b-share-icon b-share-icon_twitter"></span></a>
                </div>
            </div>

            <div class="product-delivery left">
                <?php if (!empty($shippingMethods)):?>
                    <?php foreach ($shippingMethods as $method):?>
                        <p>
                        <span>«<?= $method->name?>»</span> -
                            <?php if ($method->price):?>
                                <?= round($method->price)?> <?= $method->countryCode?>
                            <?php elseif ($method->description):?>
                                <?= $method->description?>
                            <?php else:?>
                                бесплатно
                            <?php endif;?>
                        </p>
                    <?php endforeach;?>
                <?php endif;?>
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

            <?= $form->field($quickOrder, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
                'mask' => '+380999999999',
                'options'=>[
                    'class' => 'input',
                ],
                'clientOptions'=>[
                    'clearIncomplete' => true
                ]
            ]); ?>

            <div class="enter-row">
                <?= Html::submitButton('Заказать', ['class' => 'button submit']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>

<div id="modal_form">
    <div class="clearfix">
        <div class="close right">
            <img src="/img/remove-button.png" alt="">
        </div>
    </div>
    <div class="modal-slide">
        <?php if ($product->images):?>
        <?php foreach ($product->images as $image):?>
            <div class="item">
                <?= Html::img('/uploads/product/' . $product->id .'/' . $image->imageFileName, []);?>
            </div>
        <?php endforeach;?>
        <?php endif;?>
    </div>
</div>
