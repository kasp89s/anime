<?php
use yii\widgets\Breadcrumbs;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
$groups = [];
foreach (\app\models\CustomerGroup::find()->asArray()->all() as $record) {
    $groups[$record['id']] = $record['name'];
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
            <div class="ibox float-e-margins">
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
                        <a data-toggle="tab" href="#tab-1" aria-expanded="true"> Информация о клиенте</a>
                    </li>
                    <li class="<?php if (\Yii::$app->session->hasFlash('tab') && \Yii::$app->session->getFlash('tab') == 2):?>active<?php endif;?>">
                        <a data-toggle="tab" href="#tab-2" aria-expanded="false"> Адреса</a>
                    </li>
                    <li class="<?php if (\Yii::$app->session->hasFlash('tab') && \Yii::$app->session->getFlash('tab') == 3):?>active<?php endif;?>">
                        <a data-toggle="tab" href="#tab-3" aria-expanded="false"> Телефоны</a>
                    </li>
                </ul>
                <div class="tab-content">
                <div id="tab-1" class="tab-pane <?php if (!\Yii::$app->session->hasFlash('tab')):?>active<?php endif;?>">
                    <div class="panel-body">
                        <div class="ibox-content">
                            <?php $form = ActiveForm::begin(); ?>
                            <?= $form->field($model, 'email') ?>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group field-user-password required">
                                <label class="control-label" for="user-password">Пароль</label>
                                <?= Html::input('password', 'Customer[password]', null, ['class' => 'form-control', 'id' => "customer-password"]) ?>
                                <div class="help-block"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <?= $form->field($model, 'passwordConfirm')->passwordInput() ?>
                            <div class="hr-line-dashed"></div>
                            <?= $form->field($model, 'customerGroupId')->dropDownList($groups);?>
                            <div class="hr-line-dashed"></div>
                            <?= $form->field($model, 'registrationIp')->textInput(['value' => $_SERVER['REMOTE_ADDR']]) ?>
                            <div class="hr-line-dashed"></div>
                            <?= $form->field($model, 'registrationTime')->textInput(['class' => 'form-control datepicker', 'value' => date('Y-m-d', time())]) ?>
                            <div class="hr-line-dashed"></div>
                            <?= $form->field($model, 'memo')->textArea(['rows' => '3']) ?>
                            <div class="hr-line-dashed"></div>
                            <?= $form->field($model, 'isActive')->checkbox(['value' => 1]) ?>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <?= Html::submitInput('Сохранить', ['class' => 'btn btn-primary']) ?>
                                <a href="<?= Url::to('/admin/'. Yii::$app->controller->id .'/list')?>" class="btn btn-white" type="submit">Отмена</a>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
                <div id="tab-2" class="tab-pane <?php if (\Yii::$app->session->hasFlash('tab') && \Yii::$app->session->getFlash('tab') == 2):?>active<?php endif;?>">
                    <div class="panel-body">
                        <div class="ibox-content">
                            <?php $form = ActiveForm::begin([
                                    'action' => '/admin/customer/change-address/' . $model->id,
                                ]); ?>
                            <?php foreach ($model->address as $index => $address):?>
                                <h4>Адресс <?= $index + 1?></h4>
                                <?= $form->field($address, '['.$index.']city')->textInput(['placeholder' => 'Город'])->label(false)?>
                                <?= $form->field($address, '['.$index.']address')->textInput(['placeholder' => 'Улица, дом, квартира, район, домофон, этаж...'])->label(false)?>
                                <?= $form->field($address, '['.$index.']zip')->textInput(['placeholder' => 'Индекс'])->label(false)?>
                                <div class="hr-line-dashed"></div>
                            <?php endforeach;?>
                            <div class="form-group">
                                <?= Html::submitInput('Сохранить', ['class' => 'btn btn-primary']) ?>
                                <a href="<?= Url::to('/admin/'. Yii::$app->controller->id .'/list')?>" class="btn btn-white" type="submit">Отмена</a>
                            </div>
                            <?php ActiveForm::end(); ?>

                            <h4>Добавить новый адресс</h4>
                            <?php $form = ActiveForm::begin([
                                    'action' => '/admin/customer/new-address',
                                    'enableAjaxValidation' => true
                                ]); ?>
                                <?php $addressModel = new \app\models\CustomerAddress();?>
                                <?= $form->field($addressModel, 'customerId')->hiddenInput(['value' => $model->id])->label(false)?>
                                <?= $form->field($addressModel, 'city')->textInput(['placeholder' => 'Город'])->label(false)?>
                                <?= $form->field($addressModel, 'address')->textInput(['placeholder' => 'Улица, дом, квартира, район, домофон, этаж...'])->label(false)?>
                                <?= $form->field($addressModel, 'zip')->textInput(['placeholder' => 'Индекс'])->label(false)?>
                            <div class="form-group">
                                <?= Html::submitInput('Сохранить', ['class' => 'btn btn-primary']) ?>
                                <a href="<?= Url::to('/admin/'. Yii::$app->controller->id .'/list')?>" class="btn btn-white" type="submit">Отмена</a>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
                <div id="tab-3" class="tab-pane <?php if (\Yii::$app->session->hasFlash('tab') && \Yii::$app->session->getFlash('tab') == 3):?>active<?php endif;?>">
                    <div class="panel-body">
                        <div class="ibox-content">
                            <?php $form = ActiveForm::begin([
                                    'action' => '/admin/customer/change-address/' . $model->id,
                                ]); ?>
                                <?php if (!empty($model->phones)):?>
                                <?php foreach ($model->phones as $index => $phone):?>
                                    <h4>Телефон <?= $index + 1?></h4>
                                    <?= $form->field($phone, '['.$index.']phone')->widget(\yii\widgets\MaskedInput::className(), [
                                            'mask' => '+380999999999',
                                            'options'=>[
                                                'class' => 'form-control',
                                            ],
                                            'clientOptions' => [
                                                'clearIncomplete' => true
                                            ]
                                        ])->label(false)?>
                                    <div class="hr-line-dashed"></div>
                                <?php endforeach;?>
                                    <div class="form-group">
                                        <?= Html::submitInput('Сохранить', ['class' => 'btn btn-primary']) ?>
                                        <a href="<?= Url::to('/admin/'. Yii::$app->controller->id .'/list')?>" class="btn btn-white" type="submit">Отмена</a>
                                    </div>
                                <?php endif;?>
                            <?php ActiveForm::end(); ?>

                            <h4>Добавить новый телефон</h4>
                            <?php $form = ActiveForm::begin([
                                    'action' => '/admin/customer/new-phone',
                                    'enableAjaxValidation' => true
                                ]); ?>
                            <?php $phoneModel = new \app\models\CustomerPhone();?>
                            <?= $form->field($phoneModel, 'customerId')->hiddenInput(['value' => $model->id])->label(false)?>
                            <?= $form->field($phoneModel, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
                                    'mask' => '+380999999999',
                                    'options'=>[
                                        'class' => 'form-control',
                                    ],
                                    'clientOptions' => [
                                        'clearIncomplete' => true
                                    ]
                                ])->label(false)?>
                            <div class="form-group">
                                <?= Html::submitInput('Сохранить', ['class' => 'btn btn-primary']) ?>
                                <a href="<?= Url::to('/admin/'. Yii::$app->controller->id .'/list')?>" class="btn btn-white" type="submit">Отмена</a>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
