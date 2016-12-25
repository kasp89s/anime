<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>
    <?= $form->field($model, 'body')->textArea(['rows' => '5', 'class' => 'summernote']) ?>
    <div class="hr-line-dashed"></div>
    <?= $form->field($model, 'status')->dropDownList([ 'new' => 'Новый', 'busy' => 'Рассылаеться', 'complete' => 'Выполнен', 'error' => 'Ошибка', ]) ?>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <?= Html::submitInput('Сохранить', ['class' => 'btn btn-primary']) ?>
        <a href="<?= Url::to('/admin/'. Yii::$app->controller->id .'/list')?>" class="btn btn-white" type="submit">Отмена</a>
    </div>
    <?php ActiveForm::end(); ?>

