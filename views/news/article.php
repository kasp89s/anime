<?php
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
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
        <div class="product-to-buy">
            <div class="list owl-catalog-1">
                <div class="item">
                    <a class="link">
                        <div class="image corner-message" message="Скидка - 25%">
                            <img src="img/news2.png" alt="">
                        </div>
                        <h3>Бэтмен. Суд Сов. Том 1</h3>
                    </a>
                </div>
                <div class="item">
                    <a class="link">
                        <div class="image corner-message" message="Скидка - 25%">
                            <img src="img/dummy-img1.png" alt="">
                        </div>
                        <h3>Бэтмен. Суд Сов. Том 1  Бэтмен. Суд Сов. Том 1 </h3>
                    </a>
                </div>
                <div class="item">
                    <a class="link">
                        <div class="image corner-message" message="Скидка - 25%">
                            <img src="img/dummy-img1.png" alt="">
                        </div>
                        <h3>Бэтмен. Суд Сов. Том 1</h3>
                    </a>
                </div>
                <div class="item">
                    <a class="link">
                        <div class="image corner-message" message="Скидка - 25%">
                            <img src="img/dummy-img1.png" alt="">
                        </div>
                        <h3>Бэтмен. Суд Сов. Том 1</h3>
                    </a>
                </div>

            </div>
        </div>
        <div class="social-block-horizontal">
            <img src="/img/social-horizontal.png" alt="">
        </div>
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
    </div>
</div>
