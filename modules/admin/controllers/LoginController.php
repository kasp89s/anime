<?php
/**
 * Контроллер авторизации админки.
 *
 * @version 1.0
 */
namespace app\modules\admin\controllers;

use yii\web\Controller;
use app\modules\admin\models\LoginForm;
use Yii;

/**
 * LoginController Контраллер авторизации администратора.
 *
 * @package app\modules\admin\controllers
 */
class LoginController extends Controller {

    /**
     * Перегрузка стандартного шаблона.
     *
     * @var string
     */
    public $layout = 'login';

    public function init()
    {
        parent::init();
    }

    /**
     * Главная авторизации.
     *
     * @return string
     */
    public function actionIndex()
    {

        if (\Yii::$app->user->isGuest) {
            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                Yii::$app->response->redirect(array('admin'));
            }
            return $this->render('index', compact('model'));
        }
        Yii::$app->response->redirect(array('admin'));
    }

    /**
     * Выход.
     *
     * @return mixed
     */
    public function actionOut()
    {
        Yii::$app->user->logout();

        Yii::$app->response->redirect(array('admin/login'));
    }
}
