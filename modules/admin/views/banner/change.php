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
                    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                    <?= $form->field($model, 'name') ?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'content')->textArea(['rows' => '3', 'class' => 'summernote']) ?>
                    <div class="hr-line-dashed"></div>
                    <?= Html::img('/uploads/banners/' . $model->id .'/' . $model->imageFileName, ['class' => 'img-rounded img-md']);?>
                    <?= $form->field($model, 'image')->fileInput(['accept' => 'image/*'])?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'startTime')->textInput(['class' => 'form-control datepicker']) ?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'endTime')->textInput(['class' => 'form-control datepicker']) ?>
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
