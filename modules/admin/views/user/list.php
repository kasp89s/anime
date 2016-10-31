<?php
use yii\widgets\LinkPager;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\helpers\Html;

$groups = ['all' => 'Все'];
foreach (\app\models\Group::find()->asArray()->all() as $record) {
    $groups[$record['id']] = $record['name'];
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
                    <div class="col-sm-2 m-b-xs">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <a href="<?= Url::to('/admin/'. Yii::$app->controller->id .'/create')?>" class="btn btn-primary">Создать пользователя</a>
                            </div>
                        </div>
                    </div>
                    <?= Html::beginForm([''], 'get') ?>
                    <div class="col-sm-2 m-b-xs">
                        <?= Html::dropDownList('filterGroup', null, $groups, ['class' => 'input-sm form-control input-s-sm inline'])?>
                    </div>
                    <div class="col-sm-2 m-b-xs">
                        <?= Html::dropDownList('filterGroup', null, ['all' => 'Все', 1 => 'Активен', 0 => 'Не активен'], ['class' => 'input-sm form-control input-s-sm inline'])?>
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <?= Html::textInput('search', null, ['class' => 'input-sm form-control', 'placeholder' => 'Фильтр'])?>
                            <span class="input-group-btn">
                                  <?= Html::submitButton('Найти', ['class' => 'btn btn-sm btn-primary']) ?>
                            </span>
                        </div>
                    </div>
                    <?= Html::endForm() ?>
                </div>
                <?php if (!empty($records)):?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Почта/Логин </th>
                            <th>Группа </th>
                            <th>Активность </th>
                            <th>Описание</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($records as $record): ?>
                        <tr>
                            <td><?= $record->id?></td>
                            <td><?= $record->email?></td>
                            <td><?= $record->group->name?></td>
                            <td>
                                <?php if ($record->isActive):?>
                                <span class="badge badge-primary">Активен</span>
                                <?php else:?>
                                <span class="badge badge-danger">Не активен</span>
                                <?php endif;?>
                            </td>
                            <td><?= $record->description?></td>
                            <td>
                                <a href="<?= Url::to('/admin/'. Yii::$app->controller->id .'/change/' . $record->id)?>"><i class="fa fa-edit"></i></a>
                                <a href="<?= Url::to('/admin/'. Yii::$app->controller->id .'/remove/' . $record->id)?>"><i class="fa fa-eraser"></i></a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>

                    <?php

                    echo LinkPager::widget([
                            'pagination' => $pages,
                        ]);
                    ?>
                </div>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>
</div>
