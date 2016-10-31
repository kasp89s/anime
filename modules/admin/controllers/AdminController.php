<?php
namespace app\modules\admin\controllers;

use yii\web\Controller;
use Yii;

abstract class AdminController extends Controller {

    public $layout = 'default';

    protected $_activeModel;

    protected $_post;

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function init()
    {
        parent::init();
        if (\Yii::$app->user->isGuest) {
            Yii::$app->response->redirect(array('admin/login'));
        }
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => 'Админка',
            'url' => ['/admin']
        ];
        $this->_post = Yii::$app->request->post();
    }

    public function actionCreate()
    {
        $this->_activeModel = $this->getCurrentModel(Yii::$app->controller->id);

        $model = new $this->_activeModel;
        if ($model->load($this->_post) && $model->validate()) {
            $model->save();
            Yii::$app->response->redirect(array("admin/" . Yii::$app->controller->id . "/list"));
        }

        return $this->render(Yii::$app->controller->action->id, [
                'model' => $model,
            ]);
    }

    public function actionChange($id)
    {
        $this->_activeModel = $this->getCurrentModel(Yii::$app->controller->id);

        eval("\$model = $this->_activeModel::findOne($id);");
        if (!empty($model) && $model->load($this->_post) && $model->validate()) {
            $model->save();
            Yii::$app->response->redirect(array("admin/" . Yii::$app->controller->id . "/list"));
        }

        return $this->render(Yii::$app->controller->action->id, [
                'model' => $model,
            ]);
    }

    public function actionRemove($id)
    {
        $this->_activeModel = $this->getCurrentModel(Yii::$app->controller->id);

        eval("\$model = $this->_activeModel::findOne($id);");
        if (!empty($model)) {
            $model->delete();
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    protected function getCurrentModel($controllerId)
    {
        $modelName = str_ireplace('-', ' ', $controllerId);
        return '\\app\\models\\' . str_ireplace(' ', '', ucwords($modelName));
    }
}
