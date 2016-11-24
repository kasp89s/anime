<?php
use yii\helpers\Url;
?>
<div class="middle-box text-center animated fadeInDown">
    <h1>404</h1>
    <h3 class="font-bold"><?= $message?></h3>

    <div class="error-desc">
        <a href="<?php echo Yii::$app->request->referrer?>" class="btn btn-primary">Назад</a>
    </div>
</div>
