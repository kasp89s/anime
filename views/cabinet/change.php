<?php
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<div class="breadcrumbs-block clearfix">
    <ul>
        <?php echo Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], 'homeLink' => false]);?>
    </ul>
</div>
<div class="content-container clearfix">
    <?= $this->render('//cabinet/block/leftNavBar', []); ?>
    <div class="responsive-container left">
        <h3>
            Редактирование личных данных
        </h3>
        <div class="edit-form">
            <?php $form = ActiveForm::begin([
                'action' => '',
                'enableAjaxValidation' => true,
                'options'=>['class'=>'row'],
                'fieldConfig' => [
                    'template' => '{label}<div class="info left">{input}</div>{error}',
                    'errorOptions' => ['class' => 'error text-danger'],
                    'labelOptions' => ['class' => 'label left'],
                    'inputOptions' => ['class' => ''],
                    'options' => [
                        'tag' => 'div',
                        'class' => 'form-row clearfix',
                    ],
                ],
            ]); ?>

            <?= $form->field($model, 'fullName') ?>

            <?= $form->field($model, 'email') ?>
            <div class="form-row clearfix">
            <div class="label left">
                Моб. телефон
            </div>
            <?php if (!empty($model->phones)):?>
                <div class="info left">
                <?php foreach ($model->phones as $index => $phone):?>
                        <?= $form->field($phone, '['.$index.']phone')->textInput(['placeholder' => 'Например, (066) 123-23-32'])->label(false)?>
                <?php endforeach;?>
                </div>
            <?php else:?>
                <div class="info left">
                    <?= Html::textInput('phones[]', null, ['placeholder' => 'Например, (066) 123-23-32']);?>
                </div>
            <?php endif;?>
            </div>
            <div class="form-row clearfix new-number template">
                <?= Html::textInput('phones[]', null, ['placeholder' => 'Например, (066) 123-23-32']);?>
                <a href="javascript:void(0)" class="remove-number-block">
                    <img src="/img/remove-button.png" alt="">
                </a>
            </div>
            <div class="form-row clearfix">
                        <span class="add-number">
                            Добавить еще один +
                        </span>
            </div>
            <div class="form-row clearfix">
            <div class="label left">
                Адрес:
            </div>
            <?php if (!empty($model->address)):?>
                <div class="info left">
                <?php foreach ($model->address as $index => $address):?>
                        <?= $form->field($address, '['.$index.']city')->textInput(['placeholder' => 'Город'])->label(false)?>
                        <?= $form->field($address, '['.$index.']address')->textInput(['placeholder' => 'Улица, дом, квартира, район, домофон, этаж...'])->label(false)?>
                        <?= $form->field($address, '['.$index.']zip')->textInput(['placeholder' => 'Индекс'])->label(false)?>
                <?php endforeach;?>
                </div>
            <?php else:?>
            <?php endif;?>
            </div>
            <div class="form-row clearfix new-address template">
                <?= Html::textInput('address[{index}][city]', null, ['placeholder' => 'Город']);?>
                <a href="javascript:void(0)" class="remove-address-block">
                    <img src="/img/remove-button.png" alt="">
                </a>
                <div>
                    <?= Html::textInput('address[{index}][address]', null, ['placeholder' => 'Улица, дом, квартира, район, домофон, этаж...']);?>
                </div>
                <?= Html::textInput('address[{index}][zip]', null, ['placeholder' => 'Индекс']);?>
            </div>
            <div class="form-row clearfix">
                        <span class="add-address">
                            Добавить еще один +
                        </span>
            </div>
            <div class="form-row control">
                <?= Html::submitButton('Сохранить изменения', ['class' => 'save']) ?>
                <a href="<?= Url::to('/'. Yii::$app->controller->id)?>" class="cancel">
                    Отмена
                </a>
            </div>
            <?php ActiveForm::end(); ?>
        </div>

    </div>
</div>
