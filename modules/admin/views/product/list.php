<?php
use yii\widgets\LinkPager;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\helpers\Html;
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
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <a href="<?= Url::to('/admin/'. Yii::$app->controller->id .'/create')?>" class="btn btn-primary">Создать</a>
                            </div>
                        </div>
                    </div>
                    <?= \yii\grid\GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                'id',
                                'sku',
                                'name',
//                                'description:ntext',
                                'quantityInStock',
                                // 'quantityOfSold',
                                // 'barcode1',
                                // 'barcode2',
                                // 'barcode3',
                                // 'availableTime',
                                // 'createTime',
                                // 'updateTime',
                                 'price',
                                 'currencyCode',
                                // 'productDisountId',
                                // 'productManufactureId',
                                // 'imageFileName',
                                [
                                    'attribute' => 'image',
                                    'format' => 'raw',
                                    'filter' => false,
                                    'value' => function($model) {
                                        return Html::img('/uploads/product/' . $model->id .'/' . $model->imageFileName, ['class' => 'img-rounded img-md']);
                                    }
                                ],
                                [
                                    'attribute' => 'marker.isActive',
                                    'filter' => array(1 => "Активен", 0 => "Не активен"),
                                    'format' => 'raw',
                                    'value' => function($model) {
                                        if ($model->marker->isActive) {
                                            return '<a href="' . Url::to('/admin/'. Yii::$app->controller->id .'/active/' . $model->id) . '"><span class="badge badge-primary">Активен</span></a>';
                                        } else {
                                            return '<a href="' . Url::to('/admin/'. Yii::$app->controller->id .'/active/' . $model->id) . '"><span class="badge badge-danger">Не активен</span></a>';
                                        }
                                    }
                                ],
                                [
                                    'format' => 'raw',
                                    'value' => function($model) {
                                        return '<div class="btn-group">
                                            <a href="' . Url::to('/admin/comment/list?CommentSearch%5BproductId%5D=' . $model->id) . '" class="btn btn-w-m btn-link">Мнения покупателей</a>
                                            <br>
                                            <a href="' . Url::to('/admin/'. Yii::$app->controller->id .'/clone/' . $model->id) . '" class="btn-white btn btn-xs">Дублировать</a>
                                            <a href="' . Url::to('/admin/'. Yii::$app->controller->id .'/change/' . $model->id) . '" class="btn-white btn btn-xs">Редактировать</a>
                                            <a href="' . Url::to('/admin/'. Yii::$app->controller->id .'/remove/' . $model->id) . '" class="btn-white btn btn-xs">Удалить</a>
                                        </div>';
                                    }
                                ],
                            ],
                        ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>
