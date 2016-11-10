<?php
use yii\widgets\Breadcrumbs;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$options = [];
foreach (\app\models\Option::find()->asArray()->all() as $record) {
    $options[$record['id']] = $record['name'];
}

$specifications = [];
foreach (\app\models\Specification::find()->asArray()->all() as $record) {
    $specifications[$record['id']] = $record['name'];
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
                <div class="ibox-content">
                    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                    <?= $form->field($model, 'parentId')->hiddenInput(['value' => $parent->id])->label(false) ?>
                    <?= $form->field($model, 'name') ?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'description')->textArea(['rows' => '3']) ?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'image')->fileInput(['accept' => 'image/*'])?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'optionsList')->dropDownList($options, ['multiple'=>'multiple']);?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'specificationsList')->dropDownList($specifications, ['multiple'=>'multiple']);?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'isInQuickLink')->checkbox(['value' => 1]) ?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'isActive')->checkbox(['value' => 1]) ?>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <?= Html::submitInput('Сохранить', ['class' => 'btn btn-primary']) ?>
                        <a href="<?= Url::to('/admin/'. Yii::$app->controller->id .'/list')?>" class="btn btn-white" type="submit">Cancel</a>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
