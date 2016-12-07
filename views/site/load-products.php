<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>

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