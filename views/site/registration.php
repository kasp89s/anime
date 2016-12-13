<div class="content-container clearfix">
    <div class="article-row">
         <p class="article-title">
             Поздравляем с упешной регистрацией
             </p>
         <p class="article-info">
             Весь функционал сайта вам уже доступен.
             <br/>
             Рекомендуем для подтверждения вашего электронного адреса перейти по ссылке указанной в письме.
             <?= \Yii::$app->params['serverName'] . '/registration-confirm/' . $customer->code?>
         </p>
    </div>
    
</div>
