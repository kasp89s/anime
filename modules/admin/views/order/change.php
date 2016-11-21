<?php
use yii\widgets\Breadcrumbs;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$historyModel = new \app\models\OrderHistory();

$customers = [];
foreach (\app\models\Customer::find()->asArray()->all() as $record) {
    $customers[$record['id']] = $record['email'];
}

$shippings = [];
foreach (\app\models\ShippingMethod::find()->asArray()->all() as $record) {
    $shippings[$record['id']] = $record['name'];
}

$payments = [];
foreach (\app\models\PaymentMethod::find()->asArray()->all() as $record) {
    $payments[$record['id']] = $record['name'];
}

$statuses = [];
foreach (\app\models\OrderStatus::find()->asArray()->all() as $status) {
    $statuses[$status['statusCode']] = $status['name'];
}


?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h5>&nbsp;</h5>
        <ol class="breadcrumb">
            <?php echo Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], 'homeLink' => false]);?>
        </ol>
    </div>
    <div class="col-lg-2">
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <?php if (\Yii::$app->session->hasFlash('save')):?>
            <div class="ibox-content">
                <div class="alert alert-success">
                    <?php echo \Yii::$app->session->getFlash('save')?>
                </div>
            </div>
            <?php endif;?>
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="<?php if (!\Yii::$app->session->hasFlash('tab')):?>active<?php endif;?>">
                        <a data-toggle="tab" href="#tab-1" aria-expanded="true"> Информация о заказе</a>
                    </li>
                    <li class="<?php if (\Yii::$app->session->hasFlash('tab') && \Yii::$app->session->getFlash('tab') == 2):?>active<?php endif;?>">
                        <a data-toggle="tab" href="#tab-2" aria-expanded="false"> Плательщик</a>
                    </li>
                    <li class="<?php if (\Yii::$app->session->hasFlash('tab') && \Yii::$app->session->getFlash('tab') == 3):?>active<?php endif;?>">
                        <a data-toggle="tab" href="#tab-3" aria-expanded="false"> Адрес доставки</a>
                    </li>
                    <li class="<?php if (\Yii::$app->session->hasFlash('tab') && \Yii::$app->session->getFlash('tab') == 4):?>active<?php endif;?>">
                        <a data-toggle="tab" href="#tab-4" aria-expanded="false"> История заказа</a>
                    </li>
                    <li class="<?php if (\Yii::$app->session->hasFlash('tab') && \Yii::$app->session->getFlash('tab') == 5):?>active<?php endif;?>">
                        <a data-toggle="tab" href="#tab-5" aria-expanded="false"> Информация о доставке</a>
                    </li>
                    <li class="<?php if (\Yii::$app->session->hasFlash('tab') && \Yii::$app->session->getFlash('tab') == 6):?>active<?php endif;?>">
                        <a data-toggle="tab" href="#tab-6" aria-expanded="false"> Способ оплаты</a>
                    </li>
                    <li class="<?php if (\Yii::$app->session->hasFlash('tab') && \Yii::$app->session->getFlash('tab') == 7):?>active<?php endif;?>">
                        <a data-toggle="tab" href="#tab-7" aria-expanded="false"> Товары</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane <?php if (!\Yii::$app->session->hasFlash('tab')):?>active<?php endif;?>">
                        <div class="panel-body">
                            <div class="ibox-content">
                            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                            <fieldset class="form-horizontal">
                                <?= $form->field($model, 'id') ?>

                                <?= $form->field($model, 'orderStatus') ?>

                                <?= $form->field($model, 'couponCode')?>

                                <?= $form->field($model, 'createTime')->textInput(['class' => 'form-control datepicker']) ?>

                                <?= $form->field($model, 'isFinished')->checkbox(['value' => 1]) ?>

                                <div class="form-group">
                                    <?= Html::submitInput('Сохранить', ['class' => 'btn btn-primary']) ?>
                                    <a href="<?= Url::to('/admin/'. Yii::$app->controller->id .'/list')?>" class="btn btn-white" type="submit">Cancel</a>
                                </div>
                            </fieldset>
                            <?php ActiveForm::end(); ?>
                        </div>
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane <?php if (\Yii::$app->session->hasFlash('tab') && \Yii::$app->session->getFlash('tab') == 2):?>active<?php endif;?>">
                        <div class="panel-body">
                            <div class="ibox-content">
                                <dl class="dl-horizontal m-t-md small">
                                    <dt><?= $model->customer->attributeLabels()['email']?></dt>
                                    <dd><?= $model->customer->email?></dd>
                                    <dt><?= $model->customer->address->attributeLabels()['countryCode']?></dt>
                                    <dd><?= $model->customer->address->countryCode?></dd>
                                    <dt><?= $model->customer->address->attributeLabels()['city']?></dt>
                                    <dd><?= $model->customer->address->city?></dd>
                                    <dt><?= $model->customer->address->attributeLabels()['zip']?></dt>
                                    <dd><?= $model->customer->address->zip?></dd>
                                    <dt><?= $model->customer->address->attributeLabels()['address']?></dt>
                                    <dd><?= $model->customer->address->address?></dd>
                                    <dt><?= $model->customer->address->attributeLabels()['fullName']?></dt>
                                    <dd><?= $model->customer->address->fullName?></dd>
                                    <dt><?= $model->customer->address->attributeLabels()['phone1']?></dt>
                                    <dd><?= $model->customer->address->phone1?></dd>
                                    <dt><?= $model->customer->address->attributeLabels()['phone2']?></dt>
                                    <dd><?= $model->customer->address->phone2?></dd>
                                </dl>
                            <fieldset class="form-horizontal">
                                <?php $form = ActiveForm::begin();?>

                                    <?= $form->field($model, 'customerId')->dropDownList($customers);?>

                                    <div class="form-group">
                                        <?= Html::submitInput('Сохранить', ['class' => 'btn btn-primary']) ?>
                                        <a href="<?= Url::to('/admin/'. Yii::$app->controller->id .'/list')?>" class="btn btn-white" type="submit">Cancel</a>
                                    </div>

                                <?php ActiveForm::end(); ?>

                            </fieldset>
                            </div>

                        </div>
                    </div>
                    <div id="tab-3" class="tab-pane <?php if (\Yii::$app->session->hasFlash('tab') && \Yii::$app->session->getFlash('tab') == 3):?>active<?php endif;?>">
                        <div class="panel-body">

                            <div class="ibox-content">
                                <fieldset class="form-horizontal">
                                    <?php $form = ActiveForm::begin();?>

                                        <?= $form->field($model->customerInfo, 'countryCode') ?>

                                        <?= $form->field($model->customerInfo, 'city') ?>

                                        <?= $form->field($model->customerInfo, 'zip') ?>

                                        <?= $form->field($model->customerInfo, 'address') ?>

                                        <?= $form->field($model->customerInfo, 'fullName') ?>

                                        <?= $form->field($model->customerInfo, 'phone1') ?>

                                        <?= $form->field($model->customerInfo, 'phone2') ?>

                                        <div class="form-group">
                                            <?= Html::submitInput('Сохранить', ['class' => 'btn btn-primary']) ?>
                                            <a href="<?= Url::to('/admin/'. Yii::$app->controller->id .'/list')?>" class="btn btn-white" type="submit">Cancel</a>
                                        </div>
                                    <?php ActiveForm::end(); ?>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <div id="tab-4" class="tab-pane <?php if (\Yii::$app->session->hasFlash('tab') && \Yii::$app->session->getFlash('tab') == 4):?>active<?php endif;?>">
                        <div class="panel-body">

                            <div class="ibox-content">
                                <fieldset class="form-horizontal">
                                    <?php if (!empty($model->orderHistory)):?>
                                        <h1>История заказа</h1>
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Статус</th>
                                                <th>Коментарий</th>
                                                <th>Оповещен</th>
                                                <th>Время</th>
                                                <th>Создал</th>
                                            </tr>
                                            </thead>
                                            <?php foreach ($model->orderHistory as $history):?>
                                                <tr>
                                                    <td><?= $history->orderStatus?></td>
                                                    <td><?= $history->comment?></td>
                                                    <td><?= $history->isCustomerNotified?></td>
                                                    <td><?= $history->createTime?></td>
                                                    <td><?= $history->createUser->email?></td>
                                                </tr>
                                            <?php endforeach;?>
                                        </table>
                                    <?php endif;?>
                                    <h3>Сменить статус</h3>
                                    <?php $form = ActiveForm::begin();?>

                                        <?= $form->field($historyModel, 'orderStatus')->dropDownList($statuses); ?>

                                        <?= $form->field($historyModel, 'comment')->textArea(['rows' => '3']); ?>

                                        <?= $form->field($historyModel, 'isCustomerNotified')->checkbox(['value' => 1]); ?>

                                        <div class="form-group">
                                            <?= Html::submitInput('Сохранить', ['class' => 'btn btn-primary']) ?>
                                            <a href="<?= Url::to('/admin/'. Yii::$app->controller->id .'/list')?>" class="btn btn-white" type="submit">Cancel</a>
                                        </div>
                                    <?php ActiveForm::end(); ?>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <div id="tab-5" class="tab-pane <?php if (\Yii::$app->session->hasFlash('tab') && \Yii::$app->session->getFlash('tab') == 5):?>active<?php endif;?>">
                        <div class="panel-body">
                            <dl class="dl-horizontal m-t-md small">
                                <dt><?= $model->shipping->attributeLabels()['name']?></dt>
                                <dd><?= $model->shipping->name?></dd>
                                <dt><?= $model->shipping->attributeLabels()['description']?></dt>
                                <dd><?= $model->shipping->description?></dd>
                                <dt><?= $model->shipping->attributeLabels()['price']?></dt>
                                <dd><?= $model->shipping->description?></dd>
                                <dt><?= $model->shipping->attributeLabels()['insurancePercent']?></dt>
                                <dd><?= $model->shipping->description?></dd>
                            </dl>
                            <?php $form = ActiveForm::begin(); ?>

                            <?= $form->field($model, 'shippingId')->dropDownList($shippings);?>

                            <div class="form-group">
                                <?= Html::submitInput('Сохранить', ['class' => 'btn btn-primary']) ?>
                                <a href="<?= Url::to('/admin/'. Yii::$app->controller->id .'/list')?>" class="btn btn-white" type="submit">Cancel</a>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                    <div id="tab-6" class="tab-pane <?php if (\Yii::$app->session->hasFlash('tab') && \Yii::$app->session->getFlash('tab') == 6):?>active<?php endif;?>">
                        <div class="panel-body">
                            <dl class="dl-horizontal m-t-md small">
                                <dt><?= $model->payment->attributeLabels()['name']?></dt>
                                <dd><?= $model->payment->name?></dd>
                                <dt><?= $model->payment->attributeLabels()['description']?></dt>
                                <dd><?= $model->payment->description?></dd>
                                <dt><?= $model->payment->attributeLabels()['price']?></dt>
                                <dd><?= $model->payment->description?></dd>
                                <dt><?= $model->payment->attributeLabels()['feePercent']?></dt>
                                <dd><?= $model->payment->description?></dd>
                            </dl>
                            <?php $form = ActiveForm::begin(); ?>

                            <?= $form->field($model, 'paymentId')->dropDownList($payments);?>

                            <div class="form-group">
                                <?= Html::submitInput('Сохранить', ['class' => 'btn btn-primary']) ?>
                                <a href="<?= Url::to('/admin/'. Yii::$app->controller->id .'/list')?>" class="btn btn-white" type="submit">Cancel</a>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                    <div id="tab-7" class="tab-pane <?php if (\Yii::$app->session->hasFlash('tab') && \Yii::$app->session->getFlash('tab') == 7):?>active<?php endif;?>">
                        <div class="panel-body">
                            <div class="ibox-content">
                                <fieldset class="form-horizontal">
                                    <?php if (!empty($model->products)):?>
                                        <h1>Товары в заказе</h1>
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Артикул</th>
                                                <th>Название</th>
                                                <th>Количество</th>
                                                <th>Цена товара</th>
                                                <th>Цена в заказе</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <?php foreach ($model->products as $product):?>
                                                <tr>
                                                    <td><?= $product->productSku?></td>
                                                    <td><?= $product->productName?></td>
                                                    <td>
                                                        <?= Html::beginForm('/admin/order/change-product-quantity')?>
                                                        <?= Html::activeHiddenInput($product, 'id', ['value' => $product->id])?>
                                                        <?= Html::activeTextInput($product, 'productQuantity', ['value' => $product->productQuantity]) ?>
                                                        <?= Html::submitButton('save', ['class' => 'btn-white btn btn-xs'])?>
                                                        <?= Html::endForm()?>
                                                    </td>
                                                    <td><?= $product->product->price?></td>
                                                    <td>
                                                        <?= Html::beginForm('/admin/order/change-product-price')?>
                                                        <?= Html::activeHiddenInput($product, 'id', ['value' => $product->id])?>
                                                        <?= Html::activeTextInput($product, 'productPrice', ['value' => $product->productPrice]) ?>
                                                        <?= Html::submitButton('save', ['class' => 'btn-white btn btn-xs'])?>
                                                        <?= Html::endForm()?>
                                                    </td>
                                                    <td>
                                                        <?= Html::beginForm('/admin/order/change-product-quantity')?>
                                                        <?= Html::activeHiddenInput($product, 'id', ['value' => $product->id])?>
                                                        <?= Html::activeHiddenInput($product, 'productQuantity', ['value' => 0]) ?>
                                                        <?= Html::submitButton('удалить', ['class' => 'btn-white btn btn-xs'])?>
                                                        <?= Html::endForm()?>
                                                    </td>
                                                </tr>
                                            <?php endforeach;?>
                                        </table>
                                        <dl class="dl-horizontal m-t-md small">
                                            <dt>Сумма без комисий и скидок:</dt>
                                            <dd><?= $model->total->amount?> <?= $model->total->currencyCode?></dd>
                                            <dt>Накопительная скидка:</dt>
                                            <dd><?= $model->customer->getDiscountByOrderAmount($model->total->amount)?> <?= $model->currencyCode?></dd>
                                            <dt>Купон:</dt>
                                            <dd><?= $model->discountByCoupon?> <?= $model->currencyCode?></dd>
                                            <dt>Комиссия оплаты:</dt>
                                            <dd><?= $model->payment->calculateIncrease($model->total->amount)?> <?= $model->currencyCode?></dd>
                                            <dt>Доставка:</dt>
                                            <dd><?= $model->shipping->calculateIncrease($model->total->amount)?> <?= $model->currencyCode?></dd>
                                            <dt>К оплате:</dt>
                                            <dd><?= $model->calculateAmountWithCommission()?> <?= $model->currencyCode?></dd>
                                        </dl>
                                    <?php endif;?>
                                    <h3>Добавить товар</h3>
                                    <?php $form = ActiveForm::begin();?>
                                    <?= $form->field(new \app\models\OrderProduct(), 'productSku'); ?>

                                    <div class="form-group">
                                        <?= Html::submitInput('Сохранить', ['class' => 'btn btn-primary']) ?>
                                        <a href="<?= Url::to('/admin/'. Yii::$app->controller->id .'/list')?>" class="btn btn-white" type="submit">Cancel</a>
                                    </div>
                                    <?php ActiveForm::end(); ?>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
