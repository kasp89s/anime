<?php
namespace app\components;

use yii\base\Widget;

/**
 * Витжет списка последних просмотреных товаров.
 *
 * @package app\components
 */
class LastViewWidget extends Widget{

    public $models;

    public function init(){
        parent::init();
    }

    public function run(){
        return $this->render('lastView', ['models' => $this->models]);
    }
}
?>
