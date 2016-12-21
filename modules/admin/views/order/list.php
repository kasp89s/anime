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
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'fullName',
//            [
//                'attribute' => 'fullName',
//                'filter' => [],
//                'format' => 'raw',
//                'value' => function($model) {
//                    if (empty($model->customerInfo->fullName))
//                        return null;
//
//                    return $model->customerInfo->fullName;
//                }
//            ],
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
                    if (empty($model->total->amount))
                        return null;

                    return $model->total->amount . ' ' . $model->total->currencyCode;
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
