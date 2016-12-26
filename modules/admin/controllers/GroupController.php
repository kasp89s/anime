<?php
namespace app\modules\admin\controllers;

use app\models\User;
use app\models\Group;
use Yii;
use yii\data\Pagination;

/**
 * GroupController Контроллер управления скидками.
 *
 * @package app\modules\admin\controllers
 */
class GroupController extends AdminController {

    public function actionList()
    {
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => 'Список групп',
            'url' => ['/admin/group/list']
        ];

        $query = Group::find();
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
            'label' => 'Создать группу',
            'url' => ['/admin/group/create']
        ];

        return parent::actionCreate();
    }

    public function actionChange($id)
    {
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => 'Редактировать группу',
            'url' => ['/admin/group/change']
        ];

        $model = Group::findOne($id);
        if (!empty($model) && $model->load($this->_post) && $model->validate()) {
            $model->actions = implode(',', $this->_post['Group']['availableActions']);
            $model->save();
            Yii::$app->session->setFlash('save', 'Изменения успешно сохранены.');
        }

        return $this->render(Yii::$app->controller->action->id, [
            'model' => $model,
        ]);
    }
}
