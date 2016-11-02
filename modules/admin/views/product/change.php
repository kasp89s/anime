<?php
use yii\widgets\Breadcrumbs;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
$categories = [];
foreach (\app\models\Category::find()->asArray()->all() as $record) {
    $categories[$record['id']] = $record['name'];
}
$discounts = [];
foreach (\app\models\Discount::find()->all() as $record) {
    $discounts[$record['id']] = $record['description'];
}
$manufactures = [];
foreach (\app\models\Manufacture::find()->all() as $record) {
    $manufactures[$record['id']] = $record['name'];
}
$attributes = [];
$specifications = [];
foreach ($model->categories as $category) {
    if (!empty($category->options)) {
        foreach ($category->options as $option) {
            if (empty($option->values)) continue;
            foreach ($option->values as $optionValue) {
                $attributes[$option->id . ';' . $optionValue->id] = $option->name . ' - ' . $optionValue->name . ' - ' . $optionValue->price;
            }
        }
    }

    if (!empty($category->specifications)) {
        foreach ($category->specifications as $specification) {
            $specifications[$specification->id] = $specification->name;
        }
    }
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
                        <a data-toggle="tab" href="#tab-1" aria-expanded="true"> Основные параметры</a>
                    </li>
                    <li class="<?php if (\Yii::$app->session->hasFlash('tab') && \Yii::$app->session->getFlash('tab') == 2):?>active<?php endif;?>">
                        <a data-toggle="tab" href="#tab-2" aria-expanded="false"> Входящая цена</a>
                    </li>
                    <li class="<?php if (\Yii::$app->session->hasFlash('tab') && \Yii::$app->session->getFlash('tab') == 3):?>active<?php endif;?>">
                        <a data-toggle="tab" href="#tab-3" aria-expanded="false"> Категория</a>
                    </li>
                    <li class="<?php if (\Yii::$app->session->hasFlash('tab') && \Yii::$app->session->getFlash('tab') == 4):?>active<?php endif;?>">
                        <a data-toggle="tab" href="#tab-4" aria-expanded="false"> Дополнительные параметры</a>
                    </li>
                    <li class="<?php if (\Yii::$app->session->hasFlash('tab') && \Yii::$app->session->getFlash('tab') == 5):?>active<?php endif;?>">
                        <a data-toggle="tab" href="#tab-5" aria-expanded="false"> Картинки</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane <?php if (!\Yii::$app->session->hasFlash('tab')):?>active<?php endif;?>">
                        <div class="panel-body">
                            <div class="ibox-content">
                            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                            <fieldset class="form-horizontal">
                                <?= $form->field($model, 'sku') ?>

                                <?= $form->field($model, 'name') ?>

                                <?= $form->field($model, 'description')->textArea(['rows' => '3', 'class' => 'summernote']) ?>

                                <?php if (!empty($model->imageFileName)):?>
                                    <?= Html::img('/uploads/product/' . $model->id .'/' . $model->imageFileName, ['class' => 'img-rounded img-md']);?>
                                <?php endif;?>

                                <?= $form->field($model, 'image')->fileInput(['accept' => 'image/*'])?>

                                <?= $form->field($model, 'quantityInStock') ?>

                                <?= $form->field($model, 'quantityOfSold') ?>

                                <?= $form->field($model, 'barcode1') ?>

                                <?= $form->field($model, 'barcode2') ?>

                                <?= $form->field($model, 'barcode3') ?>

                                <?= $form->field($model, 'availableTime')->textInput(['class' => 'form-control datepicker', 'value' => date('Y-m-d', time())]) ?>

                                <?= $form->field($model, 'price') ?>

                                <?= $form->field($model, 'currencyCode') ?>

                                <?= $form->field($model, 'productDisountId')->dropDownList($discounts);?>

                                <?= $form->field($model, 'productManufactureId')->dropDownList($manufactures);?>
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
                            <fieldset class="form-horizontal">
                                <?php $form = ActiveForm::begin();?>

                                    <?= $form->field($model->incomingPrice, 'price') ?>

                                    <?= $form->field($model->incomingPrice, 'currencyCode') ?>

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

                                        <?= $form->field($model, 'categoriesMultiple')->dropDownList($categories, ['multiple'=>'multiple']);?>

                                        <?= $form->field($model, 'specificationsMultiple')->dropDownList($specifications, ['multiple'=>'multiple']);?>

                                        <?= $form->field($model, 'attributesMultiple')->dropDownList($attributes, ['multiple'=>'multiple']);?>

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
                                    <?php $form = ActiveForm::begin();?>
                                         <?= $form->field($model->relatedProduct, 'relatedProductId');?>

                                        <?= $form->field($model->marker, 'isActive')->checkbox(['value' => 1]) ?>

                                        <?= $form->field($model->marker, 'isPreOrder')->checkbox(['value' => 1]) ?>

                                        <?= $form->field($model->marker, 'isSpecialOffer')->checkbox(['value' => 1]) ?>

                                        <?= $form->field($model->marker, 'isNew')->checkbox(['value' => 1]) ?>

                                        <?= $form->field($model->marker, 'isSale')->checkbox(['value' => 1]) ?>

                                        <?= $form->field($model->marker, 'isAdult')->checkbox(['value' => 1]) ?>

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
                            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                            <?= $form->field($model, 'imagesMultiple[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

                            <div class="table-responsive">
                                <?php if (!empty($model->images)):?>
                                <table class="table table-bordered table-stripped">
                                    <thead>
                                    <tr>
                                        <th>
                                            Превью
                                        </th>
                                        <th>
                                            Ссылка
                                        </th>
                                        <th>
                                            Сортировка
                                        </th>
                                        <th>
                                            Действия
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($model->images as $image):?>
                                    <tr>
                                        <td>
                                            <?= Html::img('/uploads/product/' . $model->id .'/' . $image->imageFileName, ['class' => 'img-lg']);?>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" disabled="" value="http://<?= Yii::$app->request->serverName . Url::to('/uploads/product/' . $model->id .'/' . $image->imageFileName)?>">
                                        </td>
                                        <td>
                                            <input type="text" name="ProductImage[<?= $image->id?>]rank" class="form-control" value="<?= $image->rank?>">
                                        </td>
                                        <td>
                                            <a href="<?= Url::to('/admin/'. Yii::$app->controller->id .'/image-remove/' . $image->id)?>" class="btn btn-white"><i class="fa fa-trash"></i> </a>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                    </tbody>
                                </table>
                                <?php endif;?>
                                <div class="form-group">
                                    <?= Html::submitInput('Сохранить', ['class' => 'btn btn-primary']) ?>
                                    <a href="<?= Url::to('/admin/'. Yii::$app->controller->id .'/list')?>" class="btn btn-white" type="submit">Cancel</a>
                                </div>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
