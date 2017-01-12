<?php
namespace app\components;

use yii\base\Widget;

/**
 * Витжет комментариев.
 *
 * @package app\components
 */
class CommentWidget extends Widget{

	public $model;

	public function init(){
		parent::init();
	}
	
	public function run(){
		return $this->render('comments', ['model' => $this->model]);
	}
}
?>
