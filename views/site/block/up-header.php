<?php
/**
 * Информативная полоска в хедере.
 *
 * @version 1.0
 */
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div id="up-header">
    <div class="container">
        <div class="row">
            <div class="social clearfix">
                <span>Cледите за нашими новостями, акциями и скидками</span>
                <a href="<?= Yii::$app->params['social']['facebook']['link']?>" target="_blank" class="fb"></a>
                <a href="<?= Yii::$app->params['social']['vk']['link']?>" target="_blank" class="vk"></a>
                <a href="<?= Yii::$app->params['social']['twitter']['link']?>" target="_blank" class="tw"></a>
                <a href="<?= Yii::$app->params['social']['in']['link']?>" target="_blank" class="in"></a>
            </div>
            <?php if ($this->params['pages']):?>
            <nav>
                <?php foreach ($this->params['pages'] as $page):?>
                    <li><a href="<?= Url::to('/page/'. $page->code)?>"><?= $page->title ?></a></li>
                <?php endforeach;?>
            </nav>
            <?php endif;?>
        </div>
    </div>
</div>
