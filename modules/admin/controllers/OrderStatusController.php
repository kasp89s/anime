<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\OrderStatus;
use app\modules\admin\models\search\OrderStatusSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderStatusController Контроллер управления статусами заказа.
 *
 * @package app\modules\admin\controllers
 */
class OrderStatusController extends AdminController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Список записей.
     *
     * @return string
     */
    public function actionList()
    {
        $searchModel = new OrderStatusSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render(Yii::$app->controller->action->id, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Finds the OrderStatus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return OrderStatus the loaded model
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OrderStatus::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
