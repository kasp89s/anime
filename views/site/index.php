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

<?= $this->render('//site/block/publishers', ['quick' => $quick]); ?>

<div class="catalog">
    <div class="container type2">
        <div class="panel clearfix">
            <div class="switch">
                <a href=".list1" data-filter="new">Новинки</a>
                <a href=".list2" data-filter="popular">Популярные товары</a>
                <a href=".list3" data-filter="sale">Распродажи</a>
            </div>
            <a href="javascript:void(0)" class="show-all index">показать все</a>
        </div>
        <div class="switch-list">
            <div class="list list1 owl-catalog-1">
                <?php if (!empty($newProducts)):?>
                    <?php foreach ($newProducts as $product):?>
                    <div class="item">
                        <a href="<?= Url::to('/product/' . $product->id)?>" class="link">
                            <div class="image <?= ($product->discount->value != 0) ? 'corner-message' : ''?>" message="<?= $product->discount->description?>">
                                <?= Html::img('/uploads/product/' . $product->id .'/' . $product->imageFileName, []);?>
                            </div>
                            <h3><?= $product->name?></h3>
                        </a>
                        <div class="price">
                            <b><?= number_format($product->realPrice, 0, '', ' ')?> <?= $product->currencyCode?>.</b>
                            <a href="<?= Url::to('/product/' . $product->id)?>" class="button">В КОРЗИНУ</a>
                        </div>
                    </div>
                    <?php endforeach;?>
                <?php endif;?>
            </div>
            <div class="list list2 owl-catalog-1">
                <?php if (!empty($popularProducts)):?>
                    <?php foreach ($popularProducts as $product):?>
                        <?php $product = $product->product?>
                        <div class="item">
                            <a href="<?= Url::to('/product/' . $product->id)?>" class="link">
                                <div class="image <?= ($product->discount->value != 0) ? 'corner-message' : ''?>" message="<?= $product->discount->description?>">
                                    <?= Html::img('/uploads/product/' . $product->id .'/' . $product->imageFileName, []);?>
                                </div>
                                <h3><?= $product->name?></h3>
                            </a>
                            <div class="price">
                                <b><?= number_format($product->realPrice, 0, '', ' ')?> <?= $product->currencyCode?>.</b>
                                <a href="<?= Url::to('/product/' . $product->id)?>" class="button">В КОРЗИНУ</a>
                            </div>
                        </div>
                    <?php endforeach;?>
                <?php endif;?>
            </div>
            <div class="list list3 owl-catalog-1">
                <?php if (!empty($overstock)):?>
                    <?php foreach ($overstock as $product):?>
                        <div class="item">
                            <a href="<?= Url::to('/product/' . $product->id)?>" class="link">
                                <div class="image <?= ($product->discount->value != 0) ? 'corner-message' : ''?>" message="<?= $product->discount->description?>">
                                    <?= Html::img('/uploads/product/' . $product->id .'/' . $product->imageFileName, []);?>
                                </div>
                                <h3><?= $product->name?></h3>
                            </a>
                            <div class="price">
                                <b><?= number_format($product->realPrice, 0, '', ' ')?> <?= $product->currencyCode?>.</b>
                                <a href="<?= Url::to('/product/' . $product->id)?>" class="button">В КОРЗИНУ</a>
                            </div>
                        </div>
                    <?php endforeach;?>
                <?php endif;?>
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
<?php if (!empty($viewProductList)):?>
<div class="catalog">
    <div class="container type2">
        <div class="panel clearfix">
            <h2>Последние просмотренные товары</h2>
            <a href="<?= Url::to('/cabinet/viewed')?>" class="show-all">показать все</a>
        </div>
        <?= \app\components\LastViewWidget::widget(['models' => $viewProductList]) ?>
    </div>
</div>
<?php endif;?>
<div class="text-info">
    <div class="container type2">
        <h2>Первый в Украине супермаркет аниме, манги и комиксов!</h2>
        <p>Мы рады вас приветствовать в нашем виртуальном супермаркете, который, мы на это очень надеемся, вам понравиться не только самой идеей, но и своим содержимым. </p>
        <p>Аниме - это не только японская мультипликация, но стиль жизни! Наша цель - обеспечить украинское общество любителей японской анимации и комиксов всей необходимой атрибутикой для продвижения культуры аниме в массы. В первую очередь, наш виртуальный магазин создан для почитателей аниме. Но это не значит, что здесь нет места "инакомыслящим".</p>
        <p>Мы хотим воплотить пожелания каждого посетителя. Ведь представленная у нас продукция интересна не только "настоящим отаку", но и любому человеку, так как она экзотична, качественна и в конце-концов, просто красива. Аниме культуру в массы! — это наше кредо.</p>
    </div>
</div>
