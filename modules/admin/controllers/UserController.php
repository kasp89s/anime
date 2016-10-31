<?php
/**
 * Контроллер управления пользователями.
 *
 * @version 1.0
 */
namespace app\modules\admin\controllers;

use app\models\User;
use Yii;
use yii\data\Pagination;

class UserController extends AdminController {

    public function actionList()
    {
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => 'Список пользователей',
            'url' => ['/admin/user/list']
        ];

        $query = User::find();
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
            'label' => 'Создать пользователя',
            'url' => ['/admin/user/create']
        ];

        if (Yii::$app->request->isPost) {
            $_POST['User']['hashedPassword'] = md5($this->_post['User']['password']);
        }

        return parent::actionCreate();
    }

    public function actionChange($id)
    {
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => 'Редактировать пользователя',
            'url' => ['/admin/user/change']
        ];

        if (Yii::$app->request->isPost) {
            if (empty($this->_post['User']['password'])) {
                unset($this->_post['User']['password']);
            } else {
                $_POST['User']['hashedPassword'] = md5($this->_post['User']['password']);
            }

        }

        return parent::actionChange($id);
    }
}
