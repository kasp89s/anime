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
                <a rel="nofollow"  title="ВКонтакте" class="b-share__handle b-share__link b-share-btn__vkontakte"
                   href="http://vk.com/share.php?url=http://<?= Yii::$app->getRequest()->serverName?>/news/item/<?= $record->id?>&title=<?= urlencode($record->title)?>&description=<?= urlencode($record->content)?>&image=<?= 'http://' . Yii::$app->getRequest()->serverName . '/uploads/news/' . $record->id .'/' . $record->imageFileName;?>"
                   onclick="window.open(this.href, 'mywin', 'left=20,top=20,width=600,height=500,toolbar=1,resizable=0'); return false;"><span class="b-share-icon b-share-icon_vkontakte"></span></a>
                <a rel="nofollow" target="_blank" title="Facebook" class="b-share__handle b-share__link b-share-btn__facebook"
                   href="https://www.facebook.com/sharer/sharer.php?sdk=joey&u=http://<?= Yii::$app->getRequest()->serverName?>/news/item/<?= $record->id?>&title=<?= urlencode($record->title)?>&description=<?= urlencode(strip_tags($record->content))?>&image=<?= 'http://' . Yii::$app->getRequest()->serverName . '/uploads/news/' . $record->id .'/' . $record->imageFileName;?>"
                   onclick="window.open(this.href, 'mywin', 'left=20,top=20,width=600,height=500,toolbar=1,resizable=0'); return false;"><span class="b-share-icon b-share-icon_facebook"></span></a>
                <a rel="nofollow" target="_blank" title="Twitter" class="b-share__handle b-share__link b-share-btn__twitter"
                   href="https://twitter.com/home?status=<?= urlencode($record->title)?> http://<?= Yii::$app->getRequest()->serverName?>/news/item/<?= $record->id?>"
                   onclick="window.open(this.href, 'mywin', 'left=20,top=20,width=600,height=500,toolbar=1,resizable=0'); return false;"><span class="b-share-icon b-share-icon_twitter"></span></a>
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
