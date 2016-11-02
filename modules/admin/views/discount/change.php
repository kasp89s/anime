<?php
use yii\widgets\Breadcrumbs;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
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
                <div class="ibox-content">
                    <?php $form = ActiveForm::begin(); ?>
                    <?= $form->field($model, 'description')->textArea(['rows' => '3']) ?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'type')->dropDownList(['percent' => 'Процент', 'value' => 'Сумма'])?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'value') ?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'startTime')->textInput(['class' => 'form-control datepicker', 'value' => date('Y-m-d', time())]) ?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'endTime')->textInput(['class' => 'form-control datepicker', 'value' => date('Y-m-d', time())]) ?>
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
