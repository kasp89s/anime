<?php
/**
 * Шаблон.
 *
 * @version 1.0
 */
use yii\helpers\Html;
use app\assets\AdminAsset;

AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ панель</title>
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<?php $this->beginBody() ?>
<body>

<div id="wrapper">

    <?= $this->render('block/navigation'); ?>

    <div id="page-wrapper" class="gray-bg">

        <?= $this->render('block/searchLine'); ?>

        <?= $content ?>

    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
