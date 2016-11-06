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
        <h3>
            Категории
        </h3>
        <ul>
            <li>
                <a href="#">
                    Новинки <span>(110)</span>
                </a>
            </li>
            <li>
                <a href="#">
                    Предзаказы <span>(15)</span>
                </a>
            </li>
            <li>
                <a href="#">
                    Новости магазина<span>(10)</span>
                </a>
            </li>
            <li>
                <a href="#">
                    Акции и распродажи<span>(5)</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="responsive-container left">
        <h3>
            Новости
        </h3>
        <div class="catalog-filter clearfix">
            <div class="filter left">
                    <span>
                        Сортировка:
                    </span>
                <ul>
                    <li>Новинки</li>
                    <li>Популярные</li>

                </ul>
                <span class="reset-filter">
                            Сбросить сортировку
                        </span>
            </div>
            <div class="right">
                        <span class="result">
                            Найденно <?= $count?> новостей
                        </span>
            </div>
        </div>
        <div class="news-block">
            <?php if (!empty($records)):?>
                <?php foreach ($records as $record):?>
                    <div class="news-row clearfix">
                <div class="news-title">
                    <p>
                        <?= $record->title?>
                    </p>
                    <p class="time">
                        <?= date('d.m.Y', strtotime($record->publishTime))?>
                    </p>
                </div>
                <div class="news-bloc clearfix">
                    <div class="news-image left">
                        <a class="link">
                            <div class="image corner-message">
                                <?= Html::img('/uploads/news/' . $record->id .'/' . $record->imageFileName, []);?>
                            </div>
                        </a>
                    </div>
                    <div class="news-description left">
                        <?= $record->shortContent?>
                        <a href="<?= Url::to('/'. Yii::$app->controller->id .'/article/' . $record->id)?>"> читать полностью...</a>
                    </div>
                </div>
            </div>
                <?php endforeach;?>
            <?php endif;?>
        </div>
        <div class="pagination clearfix">
            <div class="show-all left">
                <a href="#">
                    Показать еще
                </a>
            </div>
            <div class="pagination-counter right">
                <?php

                echo LinkPager::widget([
                    'pagination' => $pages,
                    'prevPageLabel' => '',
                    'nextPageCssClass' => 'next-page',
                    'nextPageLabel' => '<img src="/img/next-page.png">',
                ]);
                ?>
                <!--
                <ul>
                    <li>
                        <a href="#">1</a>
                    </li>
                    <li>
                        <a href="#">2</a>
                    </li>
                    <li>
                        <a href="#">3</a>
                    </li>
                    <li>
                        <a href="#">4</a>
                    </li>
                    <li>
                        <a href="#">5</a>
                    </li>
                    <li>
                        <a href="#">...</a>
                    </li>
                    <li>
                        <a href="#">25</a>
                    </li>
                </ul>
                <button class="next-page">
                    <img src="/img/next-page.png" alt="">
                </button>
                -->
            </div>
        </div>
    </div>
</div>