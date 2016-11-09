<?php

namespace app\controllers;

use Yii;

class AjaxController extends AbstractController
{
	private $_post;
	
	public function init()
	{
        parent::init();

        if (!Yii::$app->request->isAjax) {
			throw new \yii\web\NotFoundHttpException();
		}
		
		$this->_post = Yii::$app->request->post();
	}

	public function actionFavorite()
	{
		Yii::$app->end();
	}
}
