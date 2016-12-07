<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>

<?php if (!empty($records)):?>
    <?php foreach ($records as $record):?>
        <div class="news-row clearfix">
            <div class="news-title">
                <p>
                    <?= $record->title?>
                </p>
                <p class="time">
                    <?= date('d.m.Y', strtotime($record->publishTime))?>
                </p>
            </div>
            <div class="news-bloc clearfix">
                <div class="news-image left">
                    <a href="<?= Url::to('/'. Yii::$app->controller->id .'/item/' . $record->id)?>" class="link">
                        <div class="image corner-message">
                            <?= Html::img('/uploads/news/' . $record->id .'/' . $record->imageFileName, []);?>
                        </div>
                    </a>
                </div>
                <div class="news-description left">
                    <?= $record->shortContent?>
                    <a href="<?= Url::to('/'. Yii::$app->controller->id .'/item/' . $record->id)?>"> читать полностью...</a>
                </div>
            </div>
        </div>
    <?php endforeach;?>
<?php endif;?>