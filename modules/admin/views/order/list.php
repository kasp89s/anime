<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\search\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$statuses = [];
foreach (\app\models\OrderStatus::find()->asArray()->all() as $status) {
    $statuses[$status['statusCode']] = $status['name'];
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
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
<!--                                <a href="--><?//= Url::to('/admin/'. Yii::$app->controller->id .'/create')?><!--" class="btn btn-primary">Создать</a>-->
                            </div>
                        </div>
                    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'label' => 'Имя',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->customer->address->fullName;
                }
            ],
            'createTime',
            'updateTime',
            [
                'attribute' => 'orderStatus',
                'label' => 'Статус',
                'filter' => $statuses,
                'format' => 'raw',
                'value' => function($model) {
                    return $model->status->name;
                }
            ],
            [
                'label' => 'Итого',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->total->amount . ' ' . $model->total->currencyCode;
                }
            ],
//            'shippingId',
//            'paymentId',
//            'currencyCode',
//             'status.name',
            // 'couponCode',

            // 'updateTime',
            // 'isFinished',
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
