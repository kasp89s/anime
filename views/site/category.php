<?php
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$waitForm = new \app\models\WaitForm();
$quickOrder = new \app\models\QuickOrderForm();
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
                    <?= $subCategory->name?> <span>(<?= $subCategory->productsCount?>)</span>
                </a>
            </li>
            <?php endforeach;?>
        </ul>
        <?php endif;?>
        <?php if (!empty($availableSpecifications)):?>
            <?php foreach ($availableSpecifications as $specification):?>
                <?php if (!empty($specification->valuesByProductsCount)):?>
                <h3>
                    <?= $specification->name?>
                </h3>
                <ul>
                <?php foreach ($specification->valuesByProductsCount as $record):?>
                    <li>
                    <a href="<?= Url::to('/specification/' . $record['id'])?>">
                        <?= $record['value']?> <span>(<?php echo $record['count']?>)</span>
                    </a>
                    </li>
                <?php endforeach;?>
                <?php endif;?>
                </ul>
            <?php endforeach;?>
        <?php endif;?>
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
                    <li class="<?= !empty($_GET['time']) ? 'active' : ''?>"
                        data-url="<?= Url::to('/category/'. $category->id . '?' . http_build_query(['time' => !empty($_GET['time']) ? 0 : 1]))?>">
                        Новинки
                    </li>
                    <li class="<?= !empty($_GET['price_d']) ? 'active' : ''?>"
                        data-url="<?= Url::to('/category/'. $category->id . '?' . http_build_query(['price_d' => !empty($_GET['price_d']) ? 0 : 1]))?>">
                        Дорогие
                    </li>
                    <li class="<?= !empty($_GET['price_a']) ? 'active' : ''?>"
                        data-url="<?= Url::to('/category/'. $category->id . '?' . http_build_query(['price_a' => !empty($_GET['price_a']) ? 0 : 1]))?>">
                        Недорогие
                    </li>
                    <li class="<?= !empty($_GET['name_a']) ? 'active' : ''?>"
                        data-url="<?= Url::to('/category/'. $category->id . '?' . http_build_query(['name_a' => !empty($_GET['name_a']) ? 0 : 1]))?>">
                        А-Я
                    </li>
                    <li class="<?= !empty($_GET['name_d']) ? 'active' : ''?>"
                        data-url="<?= Url::to('/category/'. $category->id . '?' . http_build_query(['name_d' => !empty($_GET['name_d']) ? 0 : 1]))?>">
                        Я-А
                    </li>
                    <li class="<?= !empty($_GET['stock']) ? 'active' : ''?>"
                        data-url="<?= Url::to('/category/'. $category->id . '?' . http_build_query(['stock' => !empty($_GET['stock']) ? 0 : 1]))?>">
                        Наличие
                    </li>
                    <li class="<?= !empty($_GET['sold']) ? 'active' : ''?>"
                        data-url="<?= Url::to('/category/'. $category->id . '?' . http_build_query(['sold' => !empty($_GET['sold']) ? 0 : 1]))?>">
                        Популярные
                    </li>
                </ul>
                <span class="reset-filter" data-url="<?= Url::to('/category/'. $category->id)?>">Сбросить сортировку</span>
            </div>
            <div class="right">
                        <span>
                            Найденно <?= $pages->totalCount?> товаров
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
                <?php endif;?>
            </div>
            <?php endforeach;?>
            <div class="pagination clearfix">
                <div class="show-all left">
                    <a
                        href="javascript:void(0)"
                        class="show-next"
                        data-page="<?= $pages->page + 2?>"
                        data-last="<?= $pages->pageCount?>"
                        data-url="/site/load-products/<?= $category->id?>?<?= http_build_query($_GET)?>"
                        data-block=".catalog-row.list.random-product"
                    >
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


