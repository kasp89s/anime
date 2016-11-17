<div class="order-info left">
    <div class="order-info-row">
        <p class="title">
            Информация о Вашем заказе:
        </p>
        <div class="order-number clearfix">
                            <span class="left">
                                Заказ #<?= $order->id?> от <?= \app\models\Order::getDate($order->createTime)?>
                            </span>
        </div>
    </div>
    <div class="order-info-row">
        <div class="enter-info">
            Имя Фамилия: <span><?= $order->customerInfo->fullName?></span>
        </div>
        <div class="enter-info">
            Моб. телефон: <span><?= $order->customerInfo->phone1?></span>
        </div>
    </div>
    <div class="order-info-row">

        <div class="enter-info">
            Адресс: <span><?= $order->customerInfo->address?></span>
        </div>
        <div class="enter-info">
            <div class="more-info-title">
                Доставка:
            </div>
            <div class="more-info">
                <div class="radio-button">
                    <label class="form-label">
                        <input name="radio" type="radio" checked="checked">
                        <span class="label-text"></span>
                    </label>
                    <span><?= $order->shipping->name?></span>
                </div>
            </div>
        </div>
        <div class="enter-info">
            <div class="more-info-title">
                Оплата:
            </div>
            <div class="more-info">
                <div class="radio-button">
                    <label class="form-label">
                        <input name="radio2" type="radio" checked="checked">
                        <span class="label-text"></span>
                    </label>
                    <span><?= $order->payment->name?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="order-info-row">
        <div class="order-phone">
            <p>
                По вопросам заказов обращайтесь по телефону:
            </p>
            <strong><?= \Yii::$app->params['phone']?></strong>
        </div>
    </div>
</div>