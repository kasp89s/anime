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

$currencies = [];
foreach (\app\models\Currencies::find()->all() as $record) {
    $currencies[$record['code']] = $record['name'];
}

$relatedProducts = [];
foreach (\app\models\Product::find()->asArray()->all() as $record) {
    $relatedProducts[$record['id']] = $record['sku'];
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
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Основные параметры</h5>
                </div>
                <div class="ibox-content">
                    <?= $form->field($model, 'sku') ?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'name') ?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'description')->textArea(['rows' => '3', 'class' => 'summernote']) ?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'image')->fileInput(['accept' => 'image/*'])?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'imagesMultiple[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'quantityInStock') ?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'quantityOfSold') ?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'barcode1') ?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'barcode2') ?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'barcode3') ?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'availableTime')->textInput(['class' => 'form-control datepicker', 'value' => date('Y-m-d', time())]) ?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'price') ?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'currencyCode')->dropDownList($currencies); ?>
                    <div class="hr-line-dashed"></div>
                </div>
            </div>

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Входящая цена</h5>
                </div>
                <div class="ibox-content">
                    <?= $form->field($incomingPrice, 'price') ?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($incomingPrice, 'currencyCode')->dropDownList($currencies); ?>
                    <div class="hr-line-dashed"></div>
                </div>
            </div>

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Категория</h5>
                </div>
                <div class="ibox-content">
                    <?= $form->field($model, 'categoriesMultiple')->dropDownList($categories, ['multiple'=>'multiple']);?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'specificationsMultiple')->dropDownList([], ['multiple'=>'multiple', 'style' => 'display:none']);?>
                    <div class="specifications-pull"></div>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'attributesMultiple')->dropDownList([], ['multiple'=>'multiple', 'style' => 'display:none']);?>
                    <div class="hr-line-dashed"></div>
                </div>
            </div>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Дополнительные параметры</h5>
                </div>
                <div class="ibox-content">
                    <?= $form->field($relatedProduct, 'relatedProductId')->dropDownList($relatedProducts, ['data-placeholder' => 'Укакжите SKU', 'class' => 'chosen-select', 'tabindex' => 2]);?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'productDisountId')->dropDownList($discounts);?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'productManufactureId')->dropDownList($manufactures);?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($productMarker, 'isActive')->checkbox(['value' => 1]) ?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($productMarker, 'isPreOrder')->checkbox(['value' => 1]) ?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($productMarker, 'isSpecialOffer')->checkbox(['value' => 1]) ?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($productMarker, 'isNew')->checkbox(['value' => 1]) ?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($productMarker, 'isSale')->checkbox(['value' => 1]) ?>
                    <div class="hr-line-dashed"></div>
                    <?= $form->field($productMarker, 'isAdult')->checkbox(['value' => 1]) ?>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <?= Html::submitInput('Сохранить', ['class' => 'btn btn-primary']) ?>
                        <a href="<?= Url::to('/admin/'. Yii::$app->controller->id .'/list')?>" class="btn btn-white" type="submit">Отмена</a>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
