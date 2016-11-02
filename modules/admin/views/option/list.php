<?php
use yii\widgets\LinkPager;
use yii\widgets\Breadcrumbs;
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
                                <a href="<?= Url::to('/admin/'. Yii::$app->controller->id .'/create')?>" class="btn btn-primary">Создать</a>
                            </div>
                        </div>
                    </div>
                    <?php if (!empty($records)):?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <?php foreach ($records[0]->attributeLabels() as $label):?>
                                        <th><?= $label?></th>
                                    <?php endforeach;?>
                                    <th>Значения</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($records as $record): ?>
                                    <tr>
                                        <?php foreach ($record->attributeLabels() as $column => $label):?>
                                            <td><?= $record->{$column}?></td>
                                        <?php endforeach;?>
                                        <td>
                                            <ul class="dd-list">
                                                <li>
                                                    <a href="<?= Url::to('/admin/'. Yii::$app->controller->id .'/option-create/' . $record->id)?>"><i>[Новое значение]</i></a>
                                                </li>
                                            <?php if (!empty($record->values)):?>
                                            <?php foreach ($record->values as $value):?>
                                                <li>
                                                    <?= $value->name?> - <?= $value->price?>
                                                    <div class="btn-group">
                                                        <a href="<?= Url::to('/admin/'. Yii::$app->controller->id .'/option-change/' . $value->id)?>" class="btn-white btn btn-xs">Редактировать</i></a>
                                                        <a href="<?= Url::to('/admin/'. Yii::$app->controller->id .'/option-remove/' . $value->id)?>" class="btn-white btn btn-xs">Удалить</a>
                                                    </div>
                                                </li>
                                            <?php endforeach;?>
                                            <?php endif;?>
                                            </ul>
                                        </td>
                                        <td class="text-right footable-visible footable-last-column">
                                            <div class="btn-group">
                                                <a href="<?= Url::to('/admin/'. Yii::$app->controller->id .'/change/' . $record->id)?>" class="btn-white btn btn-xs">Редактировать</a>
                                                <a href="<?= Url::to('/admin/'. Yii::$app->controller->id .'/remove/' . $record->id)?>" class="btn-white btn btn-xs">Удалить</a>
                                            </div>
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
