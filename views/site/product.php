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
                    Бэтмен. Книга 1. Суд Сов
                </p>
                <p class="about-product-code">
                    Код товара: KO1016
                </p>
                <p class="product-price-info">
                    250 грн.
                    <span>
                                В наличии 7 шт.
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
                    <li>
                        Автор: <a href="#">Скотт Снайдер</a>
                    </li>
                    <li>
                        Художник: <a href="#">Грег Капулло</a>
                    </li>
                    <li>
                        Издатель: <a href="#">Азбука</a>, 2015
                    </li>
                    <li>
                        Переплет: <a href="#">Твердый переплет</a>
                    </li>
                    <li>
                        Язык: <a href="#">на русском</a>
                    </li>
                    <li>
                        Страниц: <span>192</span>
                    </li>
                    <li>
                        Формат: <span>26 х 17 см</span>
                    </li>
                </ul>
                <div class="horizontal-share">
                    <img src="/img/horizonyal-share.png" alt="">
                </div>
            </div>
            <div class="product-delivery left">
                <p>
                            <span>
                                Самовывоз - бесплатно
                            </span>
                    <br>
                    <span>
                                Курьер по Киеву - 30 грн
                            </span>
                </p>
                <p>
                    <span>«Транспортные компании»</span>
                    - Стоимость доставки расчитывается по тарифам транспортной компании.
                    Расчёт идёт при получении заказа в отделении транспортной компании.
                </p>
                <p>
                    <a href="#">
                        Читать подробнее...
                    </a>
                </p>
                <ul class="product-payment">
                    <li>
                        <a class="visa" href="#"></a>
                    </li>
                    <li>
                        <a class="master" href="#"></a>
                    </li>
                    <li>
                        <a class="privat" href="#"></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="product-row description-row">
        <h4>
            Описание: <span>Бэтмен. Книга 1. Суд Сов (KO1016)</span>
        </h4>
        <p>
            Одна из лучших работ Скотта Снайдера, блестящая графика от Грега Капулло. Первый том перезапущенной вселенной New 52!
        </p>
        <p>
            Двор Сов… Бэтмен слышал о нем. Все слышали, каждый ребенок знает стишок: «Берегись: Двор Совиный неустанно следит…». Говорят, Совы — настоящие хозяева Готэма, хоть никто их и не видел. Говорят, они вершат свой суд над неугодными. Говорят, от них не скроешься. Много чего говорят… Темный рыцарь не верит в эти слухи. Что бы там ни говорили, считает он, Готэм — город Бэтмена. Но вскоре ему предстоит понять, как глубоко он заблуждался.
        </p>
        <p>
            Мрачные легенды не лгут: Готэмом втайне правят могущественные хищники, и гнезда их повсюду…
        </p>
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
