<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrderStatus */
/* @var $form yii\widgets\ActiveForm */
?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'statusCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'isDefault')->checkbox(['value' => 1]) ?>

    <?= $form->field($model, 'isChargeble')->checkbox(['value' => 1]) ?>

    <?= $form->field($model, 'isPaid')->checkbox(['value' => 1]) ?>

    <?= $form->field($model, 'isShipped')->checkbox(['value' => 1]) ?>

    <?= $form->field($model, 'isRestock')->checkbox(['value' => 1]) ?>

    <?= $form->field($model, 'isPenalty')->checkbox(['value' => 1]) ?>

    <?= $form->field($model, 'isFinished')->checkbox(['value' => 1]) ?>

    <div class="form-group">
        <?= Html::submitInput('Сохранить', ['class' => 'btn btn-primary']) ?>
        <a href="<?= Url::to('/admin/'. Yii::$app->controller->id .'/list')?>" class="btn btn-white" type="submit">Cancel</a>
    </div>

    <?php ActiveForm::end(); ?>
