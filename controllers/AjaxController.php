<?php

namespace app\controllers;

use app\models\WishList;
use Yii;
use yii\web\Response;

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

	public function actionAddWish()
	{
        Yii::$app->response->format = Response::FORMAT_JSON;

	    $wish = WishList::find()->where([
	        'productId' => $this->_post['productId'],
	        'customerId' => $this->user->id,
        ])->one();

        if (!empty($wish)) {
            $wish->delete();
            return ['success' => 'remove'];
        }

        $wish = new WishList();
        $wish->customerId = $this->user->id;
        $wish->productId = $this->_post['productId'];
        $wish->save();

        return ['success' => 'add'];
	}
}
