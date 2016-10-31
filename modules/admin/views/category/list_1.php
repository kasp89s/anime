<?php
use yii\widgets\LinkPager;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;

function drawCategory($categories)
{
    $list = '<ul>';
    foreach ($categories as $category) {
        $addUrl = Url::to('/admin/'. Yii::$app->controller->id .'/create-sub/' . $category->id);
        $changeUrl = Url::to('/admin/'. Yii::$app->controller->id .'/change/' . $category->id);
        $removeUrl = Url::to('/admin/'. Yii::$app->controller->id .'/remove/' . $category->id);
        if (empty($category->categories)) {
            $list.= '<li>' . $category->name .
                '<a href="' . $addUrl . '"><i class="fa fa-plus-square-o"></i></a>' .
                '<a href="' . $changeUrl . '"><i class="fa fa-edit"></i></a>' .
                '<a href="' . $removeUrl . '"><i class="fa fa-eraser"></i></a>' .
                '</li>';
        } else {
            $sub = drawCategory($category->categories);
            $list.= '<li>' . $category->name . $sub . '</li>';
        }
    }
    $list.= '</ul>';
    return $list;
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
                                <a href="<?= Url::to('/admin/'. Yii::$app->controller->id .'/create')?>" class="btn btn-primary">Создать</a>
                            </div>
                        </div>
                    </div>
                    <div id="jstree1">
                        <ul>
                            <li class="jstree-open">Дерево категорий
                                <?= drawCategory($records)?>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
