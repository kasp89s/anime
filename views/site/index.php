<?php
/**
 * Главная (вьюха).
 *
 * @version 1.0
 */
use yii\helpers\Url;
use yii\helpers\Html;
?>
<?= $this->render('//site/block/main-slider', ['slides' => $slides]); ?>

<?= $this->render('//site/block/publishers'); ?>

<div class="catalog">
    <div class="container type2">
        <div class="panel clearfix">
            <div class="switch">
                <a href=".list1">Новинки</a>
                <a href=".list2">Популярные товары</a>
                <a href=".list3">Распродажи</a>
            </div>
            <a href="/" class="show-all">показать все</a>
        </div>
        <div class="switch-list">
            <div class="list list1 owl-catalog-1">
                <div class="item">
                    <a class="link">
                        <div class="image corner-message" message="Скидка - 25%">
                            <img src="/img/dummy-img1.png" alt="">
                        </div>
                        <h3>Бэтмен. Суд Сов. Том 1</h3>
                    </a>
                    <div class="price">
                        <b>1 225 грн.</b>
                        <button class="button">В КОРЗИНУ</button>
                    </div>
                </div>
                <div class="item">
                    <a class="link">
                        <div class="image corner-message" message="Скидка - 25%">
                            <img src="/img/item2.png" alt="">
                        </div>
                        <h3>Бэтмен. Суд Сов. Том 1</h3>
                    </a>
                    <div class="price">
                        <b>1 225 грн.</b>
                        <button class="button">В КОРЗИНУ</button>
                    </div>
                </div>
                <div class="item">
                    <a class="link">
                        <div class="image corner-message" message="Скидка - 25%">
                            <img src="/img/item3.png" alt="">
                        </div>
                        <h3>Бэтмен. Суд Сов. Том 1</h3>
                    </a>
                    <div class="price">
                        <b>1 225 грн.</b>
                        <button class="button">В КОРЗИНУ</button>
                    </div>
                </div>
                <div class="item">
                    <a class="link">
                        <div class="image corner-message" message="Скидка - 25%">
                            <img src="/img/item4.png" alt="">
                        </div>
                        <h3>Бэтмен. Суд Сов. Том 1</h3>
                    </a>
                    <div class="price">
                        <b>1 225 грн.</b>
                        <button class="button">В КОРЗИНУ</button>
                    </div>
                </div>
                <div class="item">
                    <a class="link">
                        <div class="image corner-message" message="Скидка - 25%">
                            <img src="/img/item5.png" alt="">
                        </div>
                        <h3>Бэтмен. Суд Сов. Том 1</h3>
                    </a>
                    <div class="price">
                        <b>1 225 грн.</b>
                        <button class="button">В КОРЗИНУ</button>
                    </div>
                </div>
                <div class="item">
                    <a class="link">
                        <div class="image corner-message" message="Скидка - 25%">
                            <img src="/img/item6.png" alt="">
                        </div>
                        <h3>Бэтмен. Суд Сов. Том 1</h3>
                    </a>
                    <div class="price">
                        <b>1 225 грн.</b>
                        <button class="button">В КОРЗИНУ</button>
                    </div>
                </div>
            </div>
            <div class="list list2 owl-catalog-1">
                <div class="item">
                    <a class="link">
                        <div class="image corner-message" message="Скидка - 25%">
                            <img src="/img/news2.png" alt="">
                        </div>
                        <h3>Бэтмен. Суд Сов. Том 1</h3>
                    </a>
                    <div class="price">
                        <b>1 225 грн.</b>
                        <button class="button">В КОРЗИНУ</button>
                    </div>
                </div>
                <div class="item">
                    <a class="link">
                        <div class="image corner-message" message="Скидка - 25%">
                            <img src="/img/dummy-img1.png" alt="">
                        </div>
                        <h3>Бэтмен. Суд Сов. Том 1</h3>
                    </a>
                    <div class="price">
                        <b>1 225 грн.</b>
                        <button class="button">В КОРЗИНУ</button>
                    </div>
                </div>
                <div class="item">
                    <a class="link">
                        <div class="image corner-message" message="Скидка - 25%">
                            <img src="/img/dummy-img1.png" alt="">
                        </div>
                        <h3>Бэтмен. Суд Сов. Том 1</h3>
                    </a>
                    <div class="price">
                        <b>1 225 грн.</b>
                        <button class="button">В КОРЗИНУ</button>
                    </div>
                </div>
                <div class="item">
                    <a class="link">
                        <div class="image corner-message" message="Скидка - 25%">
                            <img src="/img/dummy-img1.png" alt="">
                        </div>
                        <h3>Бэтмен. Суд Сов. Том 1</h3>
                    </a>
                    <div class="price">
                        <b>1 225 грн.</b>
                        <button class="button">В КОРЗИНУ</button>
                    </div>
                </div>
                <div class="item">
                    <a class="link">
                        <div class="image corner-message" message="Скидка - 25%">
                            <img src="/img/dummy-img1.png" alt="">
                        </div>
                        <h3>Бэтмен. Суд Сов. Том 1</h3>
                    </a>
                    <div class="price">
                        <b>1 225 грн.</b>
                        <button class="button">В КОРЗИНУ</button>
                    </div>
                </div>
                <div class="item">
                    <a class="link">
                        <div class="image corner-message" message="Скидка - 25%">
                            <img src="/img/dummy-img1.png" alt="">
                        </div>
                        <h3>Бэтмен. Суд Сов. Том 1</h3>
                    </a>
                    <div class="price">
                        <b>1 225 грн.</b>
                        <button class="button">В КОРЗИНУ</button>
                    </div>
                </div>
            </div>
            <div class="list list3 owl-catalog-1">
                <div class="item">
                    <a class="link">
                        <div class="image corner-message" message="Скидка - 25%">
                            <img src="/img/dummy-img1.png" alt="">
                        </div>
                        <h3>Бэтмен. Суд Сов. Том 1</h3>
                    </a>
                    <div class="price">
                        <b>1 225 грн.</b>
                        <button class="button">В КОРЗИНУ</button>
                    </div>
                </div>
                <div class="item">
                    <a class="link">
                        <div class="image corner-message" message="Скидка - 25%">
                            <img src="/img/dummy-img1.png" alt="">
                        </div>
                        <h3>Бэтмен. Суд Сов. Том 1</h3>
                    </a>
                    <div class="price">
                        <b>1 225 грн.</b>
                        <button class="button">В КОРЗИНУ</button>
                    </div>
                </div>
                <div class="item">
                    <a class="link">
                        <div class="image corner-message" message="Скидка - 25%">
                            <img src="/img/dummy-img1.png" alt="">
                        </div>
                        <h3>Бэтмен. Суд Сов. Том 1</h3>
                    </a>
                    <div class="price">
                        <b>1 225 грн.</b>
                        <button class="button">В КОРЗИНУ</button>
                    </div>
                </div>
                <div class="item">
                    <a class="link">
                        <div class="image corner-message" message="Скидка - 25%">
                            <img src="/img/dummy-img1.png" alt="">
                        </div>
                        <h3>Бэтмен. Суд Сов. Том 1</h3>
                    </a>
                    <div class="price">
                        <b>1 225 грн.</b>
                        <button class="button">В КОРЗИНУ</button>
                    </div>
                </div>
                <div class="item">
                    <a class="link">
                        <div class="image corner-message" message="Скидка - 25%">
                            <img src="/img/dummy-img1.png" alt="">
                        </div>
                        <h3>Бэтмен. Суд Сов. Том 1</h3>
                    </a>
                    <div class="price">
                        <b>1 225 грн.</b>
                        <button class="button">В КОРЗИНУ</button>
                    </div>
                </div>
                <div class="item">
                    <a class="link">
                        <div class="image corner-message" message="Скидка - 25%">
                            <img src="/img/dummy-img1.png" alt="">
                        </div>
                        <h3>Бэтмен. Суд Сов. Том 1</h3>
                    </a>
                    <div class="price">
                        <b>1 225 грн.</b>
                        <button class="button">В КОРЗИНУ</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="catalog">
    <div class="container type2">
        <div class="panel clearfix">
            <h2>Новости магазина</h2>
            <a href="<?= Url::to('/news')?>" class="show-all">показать все</a>
        </div>
        <?php if (!empty($news)):?>
        <div class="list large owl-catalog-2">
            <?php foreach ($news as $record):?>
            <div class="item">
                <a href="<?= Url::to('/news/article/' . $record->id)?>" class="link">
                    <div class="image corner-message">
                        <?= Html::img('/uploads/news/' . $record->id .'/' . $record->imageFileName, []);?>
                    </div>
                    <h3><?= $record->title?></h3>
                    <span class="date"><?= date('d.m.Y', strtotime($record->publishTime))?></span>
                </a>
            </div>
            <?php endforeach;?>
        </div>
        <?php endif;?>
    </div>
</div>
<div class="catalog">
    <div class="container type2">
        <div class="panel clearfix">
            <h2>Последние просмотренные товары</h2>
            <a href="/" class="show-all">показать все</a>
        </div>
        <div class="list owl-catalog-1">
            <div class="item">
                <a class="link">
                    <div class="image corner-message" message="Скидка - 25%">
                        <img src="/img/last1.png" alt="">
                    </div>
                    <h3>Бэтмен. Суд Сов. Том 1</h3>
                </a>
            </div>
            <div class="item">
                <a class="link">
                    <div class="image corner-message" message="Скидка - 25%">
                        <img src="/img/last2.png" alt="">
                    </div>
                    <h3>Бэтмен. Суд Сов. Том 1</h3>
                </a>
            </div>
            <div class="item">
                <a class="link">
                    <div class="image corner-message" message="Скидка - 25%">
                        <img src="/img/last3.png" alt="">
                    </div>
                    <h3>Бэтмен. Суд Сов. Том 1</h3>
                </a>
            </div>
            <div class="item">
                <a class="link">
                    <div class="image corner-message" message="Скидка - 25%">
                        <img src="/img/last4.png" alt="">
                    </div>
                    <h3>Бэтмен. Суд Сов. Том 1</h3>
                </a>
            </div>
            <div class="item">
                <a class="link">
                    <div class="image corner-message" message="Скидка - 25%">
                        <img src="/img/last5.png" alt="">
                    </div>
                    <h3>Бэтмен. Суд Сов. Том 1</h3>
                </a>
            </div>
            <div class="item">
                <a class="link">
                    <div class="image corner-message" message="Скидка - 25%">
                        <img src="/img/last6.png" alt="">
                    </div>
                    <h3>Бэтмен. Суд Сов. Том 1</h3>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="text-info">
    <div class="container type2">
        <h2>Первый в Украине супермаркет аниме, манги и комиксов!</h2>
        <p>Мы рады вас приветствовать в нашем виртуальном супермаркете, который, мы на это очень надеемся, вам понравиться не только самой идеей, но и своим содержимым. </p>
        <p>Аниме - это не только японская мультипликация, но стиль жизни! Наша цель - обеспечить украинское общество любителей японской анимации и комиксов всей необходимой атрибутикой для продвижения культуры аниме в массы. В первую очередь, наш виртуальный магазин создан для почитателей аниме. Но это не значит, что здесь нет места "инакомыслящим".</p>
        <p>Мы хотим воплотить пожелания каждого посетителя. Ведь представленная у нас продукция интересна не только "настоящим отаку", но и любому человеку, так как она экзотична, качественна и в конце-концов, просто красива. Аниме культуру в массы! — это наше кредо.</p>
    </div>
</div>
