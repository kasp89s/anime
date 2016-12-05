<?php
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
?>
<div class="breadcrumbs-block clearfix">
    <ul>
        <?php echo Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], 'homeLink' => false]);?>
    </ul>
</div>
<div class="content-container clearfix">
    <div class="fix-size-aside left">
        <h3>&nbsp;</h3>
    </div>
    <div class="responsive-container left">
        <h3>
            <?= $value?>
        </h3>
        <div class="catalog-filter clearfix">
            <div class="filter left">
                    <span>
                        Сортировка:
                    </span>
                <ul>
                    <li class="<?= !empty($_GET['time']) ? 'active' : ''?>"
                        data-url="<?= Url::to('/specification/'. $id . '?' . http_build_query(['time' => !empty($_GET['time']) ? 0 : 1]))?>">
                        Новинки
                    </li>
                    <li class="<?= !empty($_GET['price_d']) ? 'active' : ''?>"
                        data-url="<?= Url::to('/specification/'. $id . '?' . http_build_query(['price_d' => !empty($_GET['price_d']) ? 0 : 1]))?>">
                        Дорогие
                    </li>
                    <li class="<?= !empty($_GET['price_a']) ? 'active' : ''?>"
                        data-url="<?= Url::to('/specification/'. $id . '?' . http_build_query(['price_a' => !empty($_GET['price_a']) ? 0 : 1]))?>">
                        Недорогие
                    </li>
                    <li class="<?= !empty($_GET['name_a']) ? 'active' : ''?>"
                        data-url="<?= Url::to('/specification/'. $id . '?' . http_build_query(['name_a' => !empty($_GET['name_a']) ? 0 : 1]))?>">
                        А-Я
                    </li>
                    <li class="<?= !empty($_GET['name_d']) ? 'active' : ''?>"
                        data-url="<?= Url::to('/specification/'. $id . '?' . http_build_query(['name_d' => !empty($_GET['name_d']) ? 0 : 1]))?>">
                        Я-А
                    </li>
                    <li class="<?= !empty($_GET['stock']) ? 'active' : ''?>"
                        data-url="<?= Url::to('/specification/'. $id . '?' . http_build_query(['stock' => !empty($_GET['stock']) ? 0 : 1]))?>">
                        Наличие
                    </li>
                    <li class="<?= !empty($_GET['sold']) ? 'active' : ''?>"
                        data-url="<?= Url::to('/specification/'. $id . '?' . http_build_query(['sold' => !empty($_GET['sold']) ? 0 : 1]))?>">
                        Популярные
                    </li>
                </ul>
                <span class="reset-filter" data-url="<?= Url::to('/specification/'. $id)?>">Сбросить сортировку</span>
            </div>
            <div class="right">
                        <span>
                            Найденно <?= $searchCount?> товаров
                        </span>
            </div>
        </div>
        <div class="catalog-block">
            <?php foreach ($productBlocks as $products):?>
                <div class="catalog-row list random-product  clearfix">
                    <?php if (!empty($products)):?>
                        <?php foreach ($products as $product):?>
                            <div class="item">
                                <a href="<?= Url::to('/product/' . $product->id)?>" class="link">
                                    <div class="image <?= ($product->discount->value != 0) ? 'corner-message' : ''?>" message="<?= $product->discount->description?>">
                                        <?= Html::img('/uploads/product/' . $product->id .'/' . $product->imageFileName, ['class' => 'image corner-message']);?>
                                    </div>
                                    <h3><?= $product->name?></h3>
                                </a>
                                <div class="price">
                                    <div class="new-price-block">
                                        <?php if($product->discount->value != 0):?>
                                            <span class="old-price"><?= number_format($product->price, 0, '', ' ')?> <?= $product->currencyCode?>.</span>
                                        <?php endif;?>
                                        <b class="new-price"><?= number_format($product->realPrice, 0, '', ' ')?> <?= $product->currencyCode?>.</b>
                                    </div>

                                    <a href="<?= Url::to('/product/' . $product->id)?>" class="button">В КОРЗИНУ</a>
                                </div>
                            </div>
                        <?php endforeach;?>
                    <?php endif;?>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</div>
