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

            <div class="ibox ">
                <div class="ibox-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <a href="<?= Url::to('/admin/'. Yii::$app->controller->id .'/create')?>" class="btn btn-primary">Создать</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                function drawCategory($categories)
                {
                    $list = '<ol class="dd-list">';
                    foreach ($categories as $category) {
                        $addUrl = Url::to('/admin/'. Yii::$app->controller->id .'/create-sub/' . $category->id);
                        $changeUrl = Url::to('/admin/'. Yii::$app->controller->id .'/change/' . $category->id);
                        $removeUrl = Url::to('/admin/'. Yii::$app->controller->id .'/remove/' . $category->id);
                        $active = ($category->isActive) ? '<span class="badge badge-primary">Активен</span>' : '<span class="badge badge-danger">Не активен</span>';
                        if (empty($category->categories)) {
                            $list.= '<li class="dd-item" data-id="' . $category->id . '">' .
                                '<a href="' . $addUrl . '"><i class="fa fa-plus-square-o"></i></a>' .
                                ' <a href="' . $changeUrl . '"><i class="fa fa-edit"></i></a>' .
                                ' <a href="' . $removeUrl . '"><i class="fa fa-eraser"></i></a>' .
                            '<div class="dd-handle"><span class="pull-right"> '.$active.' </span>' . $category->name . '</div></li>';
                        } else {
                            $sub = drawCategory($category->categories);
                            $list.= '<li class="dd-item" data-id="' . $category->id . '">' .
                                '<a href="' . $addUrl . '"><i class="fa fa-plus-square-o"></i></a>' .
                                ' <a href="' . $changeUrl . '"><i class="fa fa-edit"></i></a>' .
                                ' <a href="' . $removeUrl . '"><i class="fa fa-eraser"></i></a>' .
                                '<div class="dd-handle"><span class="pull-right"> '.$active.' </span>' . $category->name . '</div>'.
                                $sub .
                                '</li>';
                        }
                    }
                    $list.= '</ol>';
                    return $list;
                }
                ?>
                <div class="ibox-content">
                    <div class="dd" id="nestable">
                        <?= drawCategory($records)?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
