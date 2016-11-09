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
            Просмотренные товары
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
                    <?php foreach ($products as $product):?>
                    <div class="item">
                        <a href="<?= Url::to('/product/' . $product->id)?>" class="link">
                            <div class="image <?= ($product->discount->value != 0) ? 'corner-message' : ''?>" message="<?= $product->discount->description?>">
                                <?= Html::img('/uploads/product/' . $product->id .'/' . $product->imageFileName, []);?>
                            </div>
                            <h3><?= $product->name?></h3>
                        </a>
                        <div class="price">
                            <b><?= number_format($product->realPrice, 0, '', ' ')?> <?= $product->currencyCode?>.</b>
                            <button class="button">В КОРЗИНУ</button>
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
