<?php
/**
 * Главный лейоут.
 *
 * @var $this \yii\web\View
 * @var $content string
 *
 * @version 1.0
 */

use yii\helpers\Html;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700,700italic,400italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <?= Html::csrfMetaTags() ?>
    <title><?= \Yii::$app->params['seo']['title']?></title>
    <meta name="keywords" content="<?= \Yii::$app->params['seo']['keywords']?>">
    <meta name="description" content="<?= \Yii::$app->params['seo']['description']?>">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?= $this->render('//site/block/up-header'); ?>
<div class="container">
    <div class="row">

        <?= $this->render('//site/block/header'); ?>

        <?= $content ?>

        <?= $this->render('//site/block/footer'); ?>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
