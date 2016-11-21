<?php
/**
 * Контроллер управления пользователями.
 *
 * @version 1.0
 */
namespace app\modules\admin\controllers;

use app\models\User;
use Yii;

use yii\web\NotFoundHttpException;
use app\modules\admin\models\search\UserSearch;

class UserController extends AdminController {

    public function actionList()
    {
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => 'Список пользователей',
            'url' => ['/admin/user/list']
        ];

        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render(Yii::$app->controller->action->id,
            [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
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

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
