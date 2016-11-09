<?php
namespace app\components;

use yii\base\Widget;

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
