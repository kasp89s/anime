<?php
namespace app\modules\admin\controllers;

use app\models\CustomerGroup;
use Yii;
use yii\data\Pagination;

class CustomerGroupController extends AdminController {

    public function actionList()
    {
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => 'Список групп клиентов',
            'url' => ['/admin/customer-group/list']
        ];

        $query = CustomerGroup::find();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 30]);
        $pages->pageSizeParam = false;
        $records = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy('id desc')
            ->all();

        return $this->render('list',
            [
                'records' => $records,
                'pages' => $pages,
            ]
        );
    }

    public function actionCreate()
    {
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => 'Создать группу клиентов',
            'url' => ['/admin/customer-group/create']
        ];

        return parent::actionCreate();
    }

    public function actionChange($id)
    {
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => 'Редактировать группу клиентов',
            'url' => ['/admin/customer-group/change']
        ];

        return parent::actionChange($id);
    }
}
