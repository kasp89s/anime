<?php
    use yii\widgets\Breadcrumbs;
    use yii\widgets\ActiveForm;
    use yii\helpers\Html;
    use yii\helpers\Url;
$payments = [];
foreach (\app\models\PaymentMethod::find()->asArray()->all() as $record) {
    $payments[$record['id']] = $record['name'];
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
                    <?= $form->field($model, 'name') ?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'countryCode') ?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'description')->textArea(['rows' => '3']) ?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'file')->fileInput(['accept' => 'image/*'])?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'price') ?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'insurancePercent') ?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'payments')->dropDownList($payments, ['multiple'=>'multiple']);?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'requiredValue') ?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'lopped')->checkbox(['value' => 1]) ?>
                    <div class="hr-line-dashed"></div>
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
