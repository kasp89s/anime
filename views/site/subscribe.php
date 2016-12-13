<div class="content-container clearfix">
    <div class="article-row">
            <p class="article-title">
                    Спасибо что интересуетесь нашими новостями
                </p>
            <p class="article-info">
                    Теперь вы всегда будете в курсе наших новостей, осталось сделать лишь один маленький шаг -
                    <br/>
                    для подтверждения вашего электронного адреса перейти по ссылке указанной в письме.
            </p>
        <?= \Yii::$app->params['serverName'] . \yii\helpers\Url::to('/subscribe-approve/' . $model->code)?>
        <?= \Yii::$app->params['serverName'] . \yii\helpers\Url::to('/deactivation-subscribe/' . $model->id)?>
        </div>
</div>
