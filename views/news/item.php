<?php
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
$record->products;
?>
<div class="breadcrumbs-block clearfix">
    <ul>
        <?php echo Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], 'homeLink' => false]);?>
    </ul>
</div>
<div class="content-container clearfix">
    <div class="article-row">
        <p class="article-title">
            <?= $record->title?>
        </p>
        <p class="article-time">
            <?= date('d.m.Y', strtotime($record->publishTime))?>
        </p>
        <div class="product-image">
            <?= Html::img('/uploads/news/' . $record->id .'/' . $record->imageFileName, []);?>
        </div>
        <?= $record->content?>

        <?php if (!empty($record->products)):?>
        <div class="product-to-buy">
            <div class="list owl-catalog-1">
                <?php foreach ($record->products as $product):?>
                <div class="item">
                    <a href="<?= Url::to('/product/' . $product->id)?>" class="link">
                        <div class="image <?= ($product->discount->value != 0) ? 'corner-message' : ''?>" message="<?= $product->discount->description?>">
                            <?= Html::img('/uploads/product/' . $product->id .'/' . $product->imageFileName, []);?>
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
        <?php endif;?>
        <div class="social-block-horizontal">
            <img src="/img/social-horizontal.png" alt="">
        </div>
        <?php if(!empty($viewProductList)):?>
        <div class="last-product-row">
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
</div>
