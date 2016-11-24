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
                            'email:email',
                            'group.name',
                            'registrationIp',
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
                                    $item = '';
                                    if (!empty($model->address)) {
                                        $item.= '<ul class="unstyled">';
                                            foreach($model->address->attributeLabels() as $key => $label) {
                                                $item.= '<li><strong>' . $label . '</strong>: ' . $model->address->{$key} . '</li>';
                                            }
                                        $item.= '</ul>';
                                    }
                                    return ' <div class="ibox float-e-margins border-bottom">
                                    <div class="ibox-title">
                                        <h5>Дополнительные данные</h5>
                                        <div class="ibox-tools">
                                            <a class="collapse-link">
                                                <i class="fa fa-chevron-down"></i>
                                            </a>
                                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                                <i class="fa fa-wrench"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-user">
                                                <li><a href="' . Url::to('/admin/'. Yii::$app->controller->id .'/change-address/' . $model->id) . '">Редактировать</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="ibox-content" style="display: none;">
                                        ' .$item. '
                                    </div>
                                </div>';
                                }
                            ],
                            [
                                'format' => 'raw',
                                'value' => function($model) {
                                    return '<div class="btn-group">
                                    <a href="' . Url::to('/admin/'. Yii::$app->controller->id .'/change/' . $model->id) . '" class="btn-white btn btn-xs">Редактировать</a>
                                    <a href="' . Url::to('/admin/'. Yii::$app->controller->id .'/remove/' . $model->id) . '" class="btn-white btn btn-xs">Удалить</a>
                                    <a href="' . Url::to('/admin/order/list?OrderSearch%5BcustomerId%5D=' . $model->id) . '" class="btn btn-w-m btn-link">Заказы</a>
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
