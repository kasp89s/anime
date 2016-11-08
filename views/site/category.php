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
        <?php if (!empty($category->categories)):?>
        <h3>
            Категории
        </h3>
        <ul>
            <?php foreach ($category->categories as $subCategory):?>
            <li>
                <a href="<?= Url::to('/category/' . $subCategory->id)?>">
                    <?= $subCategory->name?> <span>(<?= $subCategory->products->count()?>)</span>
                </a>
            </li>
            <?php endforeach;?>
        </ul>
        <?php endif;?>
        <?php if (!empty($category->options)):?>
            <?php foreach ($category->options as $option):?>
        <h3>
            <?= $option->name?>
        </h3>
        <ul>
            <?php if (!empty($option->values)):?>
                <?php foreach ($option->values as $value):?>
                <li>
                    <a href="<?= Url::to('/option/value/' . $value->id)?>">
                        <?= $value->name?><span>(??)</span>
                    </a>
                </li>
                <?php endforeach;?>
            <?php endif;?>
        </ul>
            <?php endforeach;?>
        <?php endif;?>
        <!--
        <h3>
            Издательства
        </h3>
        <ul>
            <li>
                <a href="#">
                    42
                </a>
            </li>
            <li>
                <a href="#">
                    Азбука-Аттикус
                </a>
            </li>
            <li>
                <a href="#">
                    Амфора
                </a>
            </li>
            <li>
                <a href="#">
                    АСТ
                </a>
            </li>
            <li>
                <a href="#">
                    Ашет - коллекция
                </a>
            </li>
            <li>
                <a href="#">
                    Комильфо
                </a>
            </li>
            <li>
                <a href="#">
                    Фабрика Комиксов
                </a>
            </li>
            <li>
                <a href="#">
                    Эксмо
                </a>
            </li>
            <li>
                <a href="#">
                    Бумкнига
                </a>
            </li>
            <li>
                <a href="#">
                    Белый Единорог
                </a>
            </li>
            <li>
                <a href="#">
                    Bubble
                </a>
            </li>
            <li>
                <a href="#">
                    Рамона
                </a>
            </li>
            <li>
                <a href="#">
                    Alt Graph
                </a>
            </li>
            <li>
                <a href="#">
                    Dark Horse
                </a>
            </li>
            <li>
                <a href="#">
                    Marvel
                </a>
            </li>
            <li>
                <a href="#">
                    DC
                </a>
            </li>
            <li>
                <a href="#">
                    Image
                </a>
            </li>
            <li>
                <a href="#">
                    Vertigo
                </a>
            </li>
            <li>
                <a href="#">
                    IDW Publishing
                </a>
            </li>
            <li>
                <a href="#">
                    Image Comics
                </a>
            </li>
        </ul>
        -->
    </div>
    <div class="responsive-container left">
        <h3>
            <?= $category->name?>
        </h3>
        <div class="catalog-filter clearfix">
            <div class="filter left">
                    <span>
                        Сортировка:
                    </span>
                <ul>
                    <li>Новинки</li>
                    <li>Дорогие</li>
                    <li>Недорогие</li>
                    <li>А-Я</li>
                    <li>Я-А</li>
                    <li>Наличие</li>
                    <li>Популярные</li>

                </ul>
                <span class="reset-filter">
                            Сбросить сортировку
                        </span>
            </div>
            <div class="right">
                        <span>
                            Найденно <?= $pages->totalCount?> товаров
                        </span>
            </div>
        </div>
        <div class="catalog-block">
            <div class="catalog-row list random-product  clearfix">
                <?php if (!empty($products)):?>
                    <?php foreach ($products as $product):?>
                        <div class="item">
                    <a href="<?= Url::to('/product/' . $product->id)?>" class="link">
                        <div class="image corner-message" message="<?= $product->discount->description?>">
                            <?= Html::img('/uploads/product/' . $product->id .'/' . $product->imageFileName, ['class' => 'image corner-message']);?>
                        </div>
                        <h3><?= $product->name?></h3>
                    </a>
                    <div class="price">
                        <div class="new-price-block">
                            <span class="old-price"><?= number_format($product->price, 0, '', ' ')?> <?= $product->currencyCode?>.</span>
                            <b class="new-price"><?= number_format($product->realPrice, 0, '', ' ')?> <?= $product->currencyCode?>.</b>
                        </div>

                        <button class="button">В КОРЗИНУ</button>
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
                </div>
            </div>

        </div>

    </div>
</div>