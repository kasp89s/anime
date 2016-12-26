<?php
namespace app\modules\admin\controllers;

use yii\web\Controller;
use Yii;

/**
 * AdminController содержит общие стандартные методы управления CRUD.
 *
 * @package app\modules\admin\controllers
 */
abstract class AdminController extends Controller {

    /**
     * Шаблон.
     *
     * @var string
     */
    public $layout = 'default';

    /**
     * Текущая модель.
     *
     * @var
     */
    protected $_activeModel;

    /**
     * Пост данные для удобной перегрузки.
     *
     * @var
     */
    protected $_post;

    /**
     * Залогиненый админ.
     *
     * @var
     */
    protected $_user;

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Инициализация.
     */
    public function init()
    {
        parent::init();
        if (\Yii::$app->user->isGuest) {
            Yii::$app->response->redirect(array('admin/login'));
            Yii::$app->end();
        }
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => 'Админка',
            'url' => ['/admin']
        ];
        $this->_post = Yii::$app->request->post();

        $this->_user = \Yii::$app->user->getIdentity();
    }

    /**
     * Предварительные действия.
     *
     * @param \yii\base\Action $event
     *
     * @return bool
     *
     * @throws \yii\web\NotFoundHttpException
     */
    public function beforeAction($event)
    {
        if (!in_array(Yii::$app->controller->id, $this->_user->group->availableActions) && Yii::$app->controller->id != 'index')
            throw new \yii\web\NotFoundHttpException('Доступ запрещен.');

        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => 'Список',
            'url' => ['/'. Yii::$app->controller->module->id .'/' .Yii::$app->controller->id. '/list']
        ];

        return parent::beforeAction($event);
    }

    /**
     * Метод создания записи.
     *
     * @return string
     */
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

    /**
     * Метод редактирования записи.
     *
     * @param integer $id Идентификатор модели.
     *
     * @return string
     */
    public function actionChange($id)
    {
        $this->_activeModel = $this->getCurrentModel(Yii::$app->controller->id);

        eval("\$model = $this->_activeModel::findOne($id);");
        if (!empty($model) && $model->load($this->_post) && $model->validate()) {
            $model->save();
            Yii::$app->session->setFlash('save', 'Изменения успешно сохранены.');
        }

        return $this->render(Yii::$app->controller->action->id, [
                'model' => $model,
            ]);
    }

    /**
     * Метод удаления модели.
     *
     * @param integer $id Идентификатор модели.
     *
     * @return \yii\web\Response
     */
    public function actionRemove($id)
    {
        $this->_activeModel = $this->getCurrentModel(Yii::$app->controller->id);

        eval("\$model = $this->_activeModel::findOne($id);");
        if (!empty($model)) {
            $model->delete();
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Метод активации модели.
     *
     * @param integer $id Идентификатор модели.
     *
     * @return \yii\web\Response
     */
    public function actionActive($id)
    {
        $this->_activeModel = $this->getCurrentModel(Yii::$app->controller->id);

        eval("\$model = $this->_activeModel::findOne($id);");
        if (!empty($model) && isset($model->isActive)) {
            $model->isActive = empty($model->isActive) ? 1 : 0;
            $model->save();
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Возвращает текущую модель.
     *
     * @param string $controllerId Текущий контроллер.
     *
     * @return string
     */
    protected function getCurrentModel($controllerId)
    {
        $modelName = str_ireplace('-', ' ', $controllerId);
        return '\\app\\models\\' . str_ireplace(' ', '', ucwords($modelName));
    }
}
