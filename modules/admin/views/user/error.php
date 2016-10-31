<?php
use yii\helpers\Url;
?>
<div class="middle-box text-center animated fadeInDown">
    <h1>404</h1>
    <h3 class="font-bold">Страница не найдена</h3>

    <div class="error-desc">
        Извините, но страница, которую вы ищете, ненайдена. Попробуйте проверить URL, а затем нажмите кнопку обновления в вашем браузере или вернитесь назад.
        <a href="<?php echo Yii::$app->request->referrer?>" class="btn btn-primary">Назад</a>
    </div>
</div>
