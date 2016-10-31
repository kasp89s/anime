<?php
/**
 * Контроллер админки по умолчанию.
 *
 * @version 1.0
 */
namespace app\modules\admin\controllers;

use yii\web\Controller;
use Yii;
class DefaultController extends Controller
{
    public $layout = 'default';

    public function init()
    {
        parent::init();
        if (\Yii::$app->user->isGuest) {
            Yii::$app->response->redirect(array('admin/login'));
        }
    }

    public function actionIndex()
    {
        return $this->render('index', []);
    }
}