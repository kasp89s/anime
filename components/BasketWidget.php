<?php
namespace app\components;

use yii\base\Widget;

/**
 * Витжет корзины.
 *
 * @package app\components
 */
class BasketWidget extends Widget{

    public $model;

    public function init(){
        parent::init();
    }

    public function run(){
        return $this->render('basket', ['model' => $this->model]);
    }
}
?>
