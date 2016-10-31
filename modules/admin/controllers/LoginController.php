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
class LoginController extends Controller {

    public $layout = 'login';

    public function init()
    {
        parent::init();
    }

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
     * Exit.
     *
     * @return mixed
     */
    public function actionOut()
    {
        Yii::$app->user->logout();

        Yii::$app->response->redirect(array('admin/login'));
    }
}