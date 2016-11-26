<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>
<?php if (!empty($models)):?>
<div class="list owl-catalog-1">
    <?php foreach ($models as $item):?>
    <div class="item">
        <a href="<?= Url::to('/product/' . $item->id)?>" class="link">
            <div class="image <?= ($item->discount->value != 0) ? 'corner-message' : ''?>" message="<?= $item->discount->description?>">
                <?= Html::img('/uploads/product/' . $item->id .'/' . $item->imageFileName, []);?>
            </div>
            <h3><?= $item->name?></h3>
        </a>
    </div>
    <?php endforeach;?>
</div>
<?php endif;?>
