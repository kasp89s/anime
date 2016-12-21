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
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create-option">
                                    Создать
                                </button>
                            </div>
                        </div>
                    </div>
                    <?= \yii\grid\GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                'id',
                                'name',
                                [
                                    'format' => 'raw',
                                    'value' => function($model) {
                                        $item = '<ul class="dd-list">
                                                <li>
                                                    <a href="javascript:void(0)" data-id="' . $model->id . '" data-toggle="modal" data-target="#create-attribute"><i>[Новое значение]</i></a>
                                                </li>';
                                        if (!empty($model->values)) {
                                            $item.= '<ul class="unstyled">';
                                            foreach($model->values as $value) {
                                                $item.= '<li>
                                                ' . $value->name . ' - ' . $value->price .'
                                                <div class="btn-group">
                                                    <a href="' . Url::to('/admin/'. Yii::$app->controller->id .'/option-change/' . $value->id) . '" class="btn-white btn btn-xs">Редактировать</i></a>
                                                    <a href="' .  Url::to('/admin/'. Yii::$app->controller->id .'/option-remove/' . $value->id) . '" class="btn-white btn btn-xs">Удалить</a>
                                                </div>
                                                </li>';
                                            }
                                            $item.= '</ul>';
                                        }
                                        return $item;
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

<div class="modal inmodal" id="create-option" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Добавить атрибут</h4>
            </div>
            <?php $form = ActiveForm::begin(['action' => '/admin/option/create']); ?>
            <div class="modal-body">
                <?= $form->field(new \app\models\Option(), 'name') ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
                <?= Html::submitInput('Сохранить', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<div class="modal inmodal" id="create-attribute" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Добавить атрибут</h4>
            </div>
            <?php
            $model = new \app\models\OptionValue();
            $form = ActiveForm::begin(['action' => '/admin/option/option-create']); ?>
            <div class="modal-body">
                <?= $form->field($model, 'productOptionId')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'name') ?>
                <div class="hr-line-dashed"></div>
                <?= $form->field($model, 'price') ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
                <?= Html::submitInput('Сохранить', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
