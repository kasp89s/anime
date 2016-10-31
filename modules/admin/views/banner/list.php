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
                <?php if (!empty($records)):?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <?php foreach ($records[0]->attributeLabels() as $column => $label):?>
                                <?php if(in_array($column, ['isActive', 'image', 'createUserId', 'updateUserId'])) continue;?>
                                <th><?= $label?></th>
                            <?php endforeach;?>
                            <th><?= $records[0]->attributeLabels()['image']?></th>
                            <th><?= $records[0]->attributeLabels()['createUserId']?></th>
                            <th><?= $records[0]->attributeLabels()['updateUserId']?></th>
                            <th><?= $records[0]->attributeLabels()['isActive']?></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($records as $record): ?>
                        <tr>
                            <?php foreach ($record->attributeLabels() as $column => $label):?>
                                <?php if(in_array($column, ['isActive', 'image', 'createUserId', 'updateUserId'])) continue;?>
                                <td><?= $record->{$column}?></td>
                            <?php endforeach;?>
                            <td>
                                <?= Html::img('/uploads/banners/' . $record->id .'/' . $record->imageFileName, ['style' => 'max-width: 200px;']);?>
                            </td>
                            <td><?= $record->createUser->email?></td>
                            <td><?= $record->updateUser->email?></td>
                            <td>
                                <?php if ($record->isActive):?>
                                <span class="badge badge-primary">Активен</span>
                                <?php else:?>
                                <span class="badge badge-danger">Не активен</span>
                                <?php endif;?>
                            </td>
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