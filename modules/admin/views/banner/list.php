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
                    <div class="col-sm-2 m-b-xs">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <a href="<?= Url::to('/admin/'. Yii::$app->controller->id .'/create')?>" class="btn btn-primary">Создать</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?= \yii\grid\GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'name',
                            'content:ntext',
                            [
                                'attribute' => 'image',
                                'format' => 'raw',
                                'filter' => false,
                                'value' => function($model) {
                                   return Html::img('/uploads/banners/' . $model->id .'/' . $model->imageFileName, ['class' => 'img-rounded img-md']);
                                }
                            ],
                            'startTime',
                            // 'endTime',
                            // 'isActive',
                            // 'createTime',
                            // 'updateTime',
                            // 'createUserId',
                            // 'updateUserId',

                            [
                                'attribute' => 'isActive',
                                'filter' => array(1 => "Активен", 0 => "Не активен"),
                                'format' => 'raw',
                                'value' => function($model) {
                                    if ($model->isActive) {
                                        return '<span class="badge badge-primary">Активен</span>';
                                    } else {
                                        return '<span class="badge badge-danger">Не активен</span>';
                                    }
                                }
                            ],
                            [
                                'format' => 'raw',
                                'value' => function($model) {
                                    return '<div class="btn-group">
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
