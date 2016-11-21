<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\models\OrderStatus */

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
            <?php if (\Yii::$app->session->hasFlash('save')):?>
                <div class="ibox-content">
                    <div class="alert alert-success">
                        <?php echo \Yii::$app->session->getFlash('save')?>
                    </div>
                </div>
            <?php endif;?>
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <?= $this->render('_form', [
                            'model' => $model,
                        ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
