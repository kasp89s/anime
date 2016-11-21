<?php

namespace app\modules\admin\controllers;

use app\models\Coupon;
use app\models\OrderHistory;
use app\models\OrderStatus;
use Yii;
use app\models\Order;
use app\modules\admin\models\search\OrderSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends AdminController
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
     * Lists all Order models.
     * @return mixed
     */
    public function actionList()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render(Yii::$app->controller->action->id, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionChange($id)
    {
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => 'Редактировать заказ',
            'url' => ['/'. Yii::$app->controller->module->id .'/'. Yii::$app->controller->id .'/'. Yii::$app->controller->action->id]
        ];

        $model = Order::findOne($id);
        if (empty($model))
            throw new \yii\web\NotFoundHttpException();

        $couponCode = $model->couponCode;
        $historyModel = new OrderHistory();

        if ($model->load($this->_post) && $model->validate()) {
            $model->updateTime = date('Y-m-d H:i:s', time());

            if (!empty($model->couponCode) && empty($couponCode)) {

                // Пересчитываем с учётом купона.
                $coupon = Coupon::find()->where(
                    [
                        'code' => $model->couponCode,
                        'isActive' => 1,
                    ])
                    ->andWhere('startTime <= :time AND endTime >= :time AND minimalOrderCost <= :orderAmount',
                        [
                            ':time' => date('Y-m-d H:i:s', time()),
                            ':orderAmount' => $model->totalWithoutCommission
                        ])
                    ->one();

                if (!empty($coupon)) {
                    $model->total->amount = $model->calculateAmountWithCommission();
                    $model->total->save();
                } else {
                    $model->couponCode = null;
                }
            }

            $model->save();
            Yii::$app->session->setFlash('save', 'Изменения успешно сохранены.');
        }

        if ($model->customerInfo->load($this->_post) && $model->customerInfo->validate()) {
            $model->customerInfo->save();
            Yii::$app->session->setFlash('save', 'Изменения успешно сохранены.');
            Yii::$app->session->setFlash('tab', 3);
        }

        $historyModel->orderId = $model->id;
        $historyModel->createUserId = \Yii::$app->user->id;
        if ($historyModel->load($this->_post) && $historyModel->validate()) {
            $isRecalculate = false;
            $newStatus = OrderStatus::find()->where(['statusCode' => $historyModel->orderStatus])->one();
            if ($newStatus->isAway($model->status)) {
                $model->awayProducts();
            }

            if ($newStatus->isReturn($model->status)) {
                $model->returnProducts();
            }

            if ($newStatus->isRecalculateGroup($model->status)) {
                $isRecalculate = true;
            }
            $model->orderStatus = $newStatus->statusCode;
            $model->save();
            $historyModel->save();

            if ($isRecalculate) {
                $model->recalculateGroup();
            }

            Yii::$app->session->setFlash('save', 'Изменения успешно сохранены.');
            Yii::$app->session->setFlash('tab', 4);
        }

        return $this->render(Yii::$app->controller->action->id, [
                'model' => $model,
                'historyModel' => $historyModel,
            ]);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
