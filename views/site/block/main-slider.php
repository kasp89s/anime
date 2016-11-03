<?php
/**
 * Слайдер.
 *
 * @version 1.0
 */
use yii\helpers\Html;
?>
<?php if (!empty($slides)):?>
<div class="main-slider">
    <?php foreach ($slides as $slide):?>
    <div>
        <div class="item">
            <div class="image">
                <?= Html::img('/uploads/banners/' . $slide->id .'/' . $slide->imageFileName);?>
            </div>
            <div class="text">
                <?= $slide->content?>
            </div>
        </div>
    </div>
    <?php endforeach;?>
</div>
<?php endif;?>
