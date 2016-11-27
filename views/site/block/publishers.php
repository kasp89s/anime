<?php
/**
 * Быстрые ссылки.
 *
 * @version 1.0
 */
use yii\helpers\Html;
use yii\helpers\Url;
?>
<?php if (!empty($quick)):?>
<div class="publishers">
    <div class="container">
        <div class="row">
            <a href="javascript:void(0)" class="all">Быстрые<br>ссылки</a>
            <div class="owl">
                <?php foreach ($quick as $category):?>
                <a href="<?= Url::to('/category/' . $category->id)?>"><?= Html::img('/uploads/category/' . $category->id .'/' . $category->imageFileName, []);?></a>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</div>
<?php endif;?>
