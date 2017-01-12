<?php
/**
 * Контроллер админки по умолчанию.
 *
 * @version 1.0
 */
namespace app\modules\admin\controllers;

use yii\web\Controller;
use Yii;

/**
 * IndexController контроллер главной страницы админ панели.
 *
 * @package app\modules\admin\controllers
 */
class IndexController extends AdminController
{
    public function actionIndex()
    {
        return $this->render('index', []);
    }
}
