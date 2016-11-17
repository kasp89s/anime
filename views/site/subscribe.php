<div class="content-container clearfix">
    Ссылка активации подписки: <?= \Yii::$app->params['serverName'] . \yii\helpers\Url::to('/subscribe-approve/' . $model->code)?> <br />

    Отписаться: <?= \Yii::$app->params['serverName'] . \yii\helpers\Url::to('/deactivation-subscribe/' . $model->id)?>
</div>