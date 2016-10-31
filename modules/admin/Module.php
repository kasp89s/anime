<?php
/**
 * Главный класс модуля админки.
 *
 * @version 1.0
 */
namespace app\modules\admin;
use Yii;
class Module extends \yii\base\Module
{
    public function init()
    {
        parent::init();

        \Yii::$app->errorHandler->errorAction='admin/user/error';
    }
}