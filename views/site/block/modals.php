<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$waitForm = new \app\models\WaitForm();
?>
<div id="overlay" style="display: none;"></div>

<div class="modal wait-modal" style="opacity: 0; top: 45%; display: none;">

    <div class="build-in-popup" id="recover-password">

        <div class="close right">
            <img src="/img/remove-button.png" alt="">
        </div>

        <h2>Уведомить о наличие</h2>
        <div class="wait-success">Спасибо за подписку!</div>
        <div class="table wait-form">
            <?php $form = ActiveForm::begin([
                'action' => '/site/wait-guest',
                'enableAjaxValidation' => true,
                'options'=>['class'=>'row'],
                'fieldConfig' => [
                    'template' => '{label}{input}{error}',
                    'errorOptions' => ['class' => 'error text-danger'],
                    'labelOptions' => ['class' => ''],
                    'inputOptions' => ['class' => 'input'],
                    'options' => [
                        'tag' => 'div',
                    ],
                ],
            ]); ?>

            <?= $form->field($waitForm, 'productId')->hiddenInput(['value' => ''])->label(false) ?>

            <?= $form->field($waitForm, 'email') ?>

            <div class="enter-row">
                <?= Html::submitButton('Подтвердить', ['class' => 'button submit']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
