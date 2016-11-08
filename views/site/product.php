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
                    <?php echo $product->realPrice?> <?php echo $product->currencyCode?>.
                    <span>
                                В наличии <?php echo $product->quantityInStock?> шт.
                            </span>
                </p>
                <button class="add-product">
                    Добавить в корзину
                </button>
                <div class="rating-info">
                    <button class="add-wish">
                        в избранное
                    </button>
                    <ul class="rating">
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                    </ul>
                    <span>
                                3 отзыва
                            </span>
                </div>
                <ul class="description-list">
                    <?php if(!empty($product->productAttributes)):?>
                        <?php foreach ($product->productAttributes as $attribute):?>
                        <li>
                            <?= $attribute->option->name?>:
                            <a href="<?= Url::to('/option/value/' . $attribute->optionValue->id)?>"><?= $attribute->optionValue->name?></a>
                        </li>
                        <?php endforeach;?>
                    <?php endif;?>
                    <?php if (!empty($product->specificationRelations)):?>
                        <?php foreach ($product->specificationRelations as $relation):?>
                            <li>
                                <?= $relation->specification->name?>: <span><?= $relation->value?></span>
                            </li>
                         <?php endforeach;?>
                    <?php endif;?>
                </ul>
                <div class="horizontal-share">
                    <img src="/img/horizonyal-share.png" alt="">
                </div>
            </div>

            <div class="product-delivery left">
                <?php if (!empty($shippingMethods)):?>
                <p>
                    <?php foreach ($shippingMethods as $method):?>
                        <span><?= $method->name?> - <?= ($method->price) ? round($method->price) . ' ' . $method->countryCode : 'бесплатно'?></span><br>
                    <?php endforeach;?>
                </p>
                <?php endif;?>
                <p>
                    <span>«Транспортные компании»</span>
                    - Стоимость доставки расчитывается по тарифам транспортной компании.
                    Расчёт идёт при получении заказа в отделении транспортной компании.
                </p>
                <p>
                    <a href="<?= Url::to('/'. $this->params['pages']['delivery']->code)?>">
                        Читать подробнее...
                    </a>
                </p>
                <?php if (!empty($paymentMethods)):?>
                <ul class="product-payment">
                    <?php foreach ($paymentMethods as $method):?>
                    <li>
                        <a class="visa" href="#"></a>
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
        <?php echo $product->name?>
    </div>
    <div class="product-row clearfix">
        <div class="last-comments left">
            <h4>
                Последние отзывы
            </h4>
            <div class="comments-row">
                <div class="comments-row-info">
                            <span class="name">
                                Евгений
                            </span>
                    <ul class="rating">
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                    </ul>
                    <span class="time">
                                17 июля 2015 в 10:40
                            </span>
                    <p>
                        Отличный комикс!!!
                    </p>
                    <a href="#" class="answer">
                        Ответить
                    </a>
                </div>

            </div>
            <div class="comments-row">
                <div class="comments-row-info">
                            <span class="name">
                                Евгений
                            </span>
                    <ul class="rating">
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                    </ul>
                    <span class="time">
                                17 июля 2015 в 10:40
                            </span>
                    <p>
                        Лучшее, что я читал. Отличный комикс на все времена.
                    </p>
                    <a href="#" class="answer">
                        Ответить
                    </a>
                </div>

            </div>
            <div class="comments-row">
                <div class="comments-row-info">
                            <span class="name">
                                Евгений
                            </span>
                    <ul class="rating">
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                    </ul>
                    <span class="time">
                                17 июля 2015 в 10:40
                            </span>
                    <p>
                        Скотт Снайдер дал Бэтсу новую жизнь. Просто отлично, рекомендую всем к прочтению.
                    </p>
                    <a href="#" class="answer">
                        Ответить
                    </a>
                </div>

            </div>
        </div>
        <div class="add-comments right">
            <h4>
                Напишите свой отзыв
            </h4>
            <textarea>

                    </textarea>
            <p>
                Ваше имя
            </p>
            <input type="text">
            <p>
                E-mail
            </p>
            <input type="text">
            <div class="comments-control clearfix">
                <div class="left">
                            <span>
                                Оценка
                            </span>
                    <ul class="rating">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                </div>
                <button class="add right">
                    Добавить отзыв
                </button>
            </div>
        </div>
    </div>
    <div class="product-row">
        <div class="last-view clearfix">
            <h4 class="left">
                Последние просмотренные товары
            </h4>
            <div class="show-all-last right">
                <a href="#">
                    Показать все
                </a>
            </div>
        </div>
        <div class="list owl-catalog-1">
            <div class="item">
                <a class="link">
                    <div class="image corner-message" message="Скидка - 25%">
                        <img src="/img/news2.png" alt="">
                    </div>
                    <h3>Бэтмен. Суд Сов. Том 1</h3>
                </a>
            </div>
            <div class="item">
                <a class="link">
                    <div class="image corner-message" message="Скидка - 25%">
                        <img src="/img/dummy-img1.png" alt="">
                    </div>
                    <h3>Бэтмен. Суд Сов. Том 1  Бэтмен. Суд Сов. Том 1 </h3>
                </a>
            </div>
            <div class="item">
                <a class="link">
                    <div class="image corner-message" message="Скидка - 25%">
                        <img src="/img/dummy-img1.png" alt="">
                    </div>
                    <h3>Бэтмен. Суд Сов. Том 1</h3>
                </a>
            </div>
            <div class="item">
                <a class="link">
                    <div class="image corner-message" message="Скидка - 25%">
                        <img src="/img/dummy-img1.png" alt="">
                    </div>
                    <h3>Бэтмен. Суд Сов. Том 1</h3>
                </a>
            </div>
            <div class="item">
                <a class="link">
                    <div class="image corner-message" message="Скидка - 25%">
                        <img src="/img/dummy-img1.png" alt="">
                    </div>
                    <h3>Бэтмен. Суд Сов. Том 1</h3>
                </a>
            </div>
            <div class="item">
                <a class="link">
                    <div class="image corner-message" message="Скидка - 25%">
                        <img src="/img/dummy-img1.png" alt="">
                    </div>
                    <h3>Бэтмен. Суд Сов. Том 1</h3>
                </a>
            </div>
            <div class="item">
                <a class="link">
                    <div class="image corner-message" message="Скидка - 25%">
                        <img src="/img/dummy-img1.png" alt="">
                    </div>
                    <h3>Бэтмен. Суд Сов. Том 1</h3>
                </a>
            </div>
        </div>
    </div>
</div>
