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
            Список желаний
        </h3>
        <div class="favorite-block clearfix">
            <div class="favorite-row clearfix">
                <div class="filter left">
                            <span>
                                Сортировка:
                            </span>
                    <ul>
                        <li class="<?= !empty($_GET['time']) ? 'active' : ''?>"
                            data-url="<?= Url::to('/cabinet/wish-list?' . http_build_query(['time' => !empty($_GET['time']) ? 0 : 1]))?>">
                            Дата добавления
                        </li>
                        <li class="<?= !empty($_GET['price_d']) ? 'active' : ''?>"
                            data-url="<?= Url::to('/cabinet/wish-list?' . http_build_query(['price_d' => !empty($_GET['price_d']) ? 0 : 1]))?>">
                            Дорогие
                        </li>
                        <li class="<?= !empty($_GET['price_a']) ? 'active' : ''?>"
                            data-url="<?= Url::to('/cabinet/wish-list?' . http_build_query(['price_a' => !empty($_GET['price_a']) ? 0 : 1]))?>">
                            Недорогие
                        </li>
                        <li class="<?= !empty($_GET['stock']) ? 'active' : ''?>"
                            data-url="<?= Url::to('/cabinet/wish-list?' . http_build_query(['stock' => !empty($_GET['stock']) ? 0 : 1]))?>">
                            Наличие
                        </li>
                        <li class="<?= !empty($_GET['sold']) ? 'active' : ''?>"
                            data-url="<?= Url::to('/cabinet/wish-list?' . http_build_query(['sold' => !empty($_GET['sold']) ? 0 : 1]))?>">
                            Популярные
                        </li>
                    </ul>
                    <span class="reset-filter" data-url="<?= Url::to('/cabinet/wish-list')?>">Сбросить сортировку</span>
                </div>
                <div class="favorite-product-price right">
                            <span>
                                <?= $productsCount?> товаров на сумму <strong><?= number_format($totalAmount, 0, '', ' ')?> грн.</strong>
                            </span>
                </div>
            </div>
            <?php if (!empty($wishProducts)):?>
                <?php foreach ($wishProducts as $products):?>
                <div class="favorite-row product clearfix">
                <div class="list list1 random-product">
                    <?php foreach ($products as $product):?>
                    <div class="item">
                        <button class="remove-favorite" data-id="<?= $product->id?>">
                            <img src="/img/remove-button.png" alt="">
                        </button>
                        <a href="<?= Url::to('/product/' . $product->id)?>" class="link">
                            <div class="image <?= ($product->discount->value != 0) ? 'corner-message' : ''?>" message="<?= $product->discount->description?>">
                                <?= Html::img('/uploads/product/' . $product->id .'/' . $product->imageFileName, []);?>
                            </div>
                            <h3><?= $product->name?></h3>
                        </a>
                        <div class="price">
                            <b><?= number_format($product->realPrice, 0, '', ' ')?> <?= $product->currencyCode?>.</b>
                            <?php if($product->quantityInStock > 0):?>
                                <a href="<?= Url::to('/product/' . $product->id)?>" class="button">В КОРЗИНУ</a>
                            <?php else:?>
                                <a
                                    href="javascript:void(0)"
                                    data-product="<?= $product->id?>"
                                    data-user="<?= (!empty($this->params['user'])) ? $this->params['user']->id : ''?>"
                                    class="button wait-modal-btn">уведомить о наличии</a>
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
