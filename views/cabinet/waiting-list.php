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
            Лист ожидания
        </h3>
        <div class="favorite-block clearfix">
            <div class="favorite-row clearfix">
                <div class="filter left">
                            <span>
                                Сортировка:
                            </span>
                    <ul>
                        <li>Дата добавления</li>
                        <li>Дорогие</li>
                        <li>Недорогие</li>
                        <li>Наличие</li>
                        <li>Популярные</li>
                    </ul>
                    <span class="reset-filter">
                                Сбросить сортировку
                            </span>
                </div>
                <div class="favorite-product-price right">
                            <span>
                                <?= $productsCount?> товаров на сумму <strong><?= number_format($totalAmount, 0, '', ' ')?> грн.</strong>
                            </span>
                </div>
            </div>
            <?php if (!empty($viewProductList)):?>
                <?php foreach ($viewProductList as $products):?>
                    <div class="favorite-row product clearfix">
                        <div class="list list1 random-product">
                            <?php foreach ($products as $model):?>
                                <div class="item">
                                    <a href="<?= Url::to('/product/' . $model->product->id)?>" class="link">
                                        <div class="image <?= ($model->product->discount->value != 0) ? 'corner-message' : ''?>" message="<?= $model->product->discount->description?>">
                                            <?= Html::img('/uploads/product/' . $model->product->id .'/' . $model->product->imageFileName, []);?>
                                        </div>
                                        <h3><?= $model->product->name?></h3>
                                    </a>
                                    <div class="price">
                                        <b><?= number_format($model->product->realPrice, 0, '', ' ')?> <?= $model->product->currencyCode?>.</b>
                                        <?php if($model->product->quantityInStock > 0):?>
                                            <button class="button">В КОРЗИНУ</button>
                                        <?php endif;?>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                <?php endforeach;?>
            <?php endif;?>
        </div>
    </div>
</div>
