<?php

namespace app\modules\admin\controllers;

use app\models\Coupon;
use app\models\OrderHistory;
use app\models\OrderProduct;
use app\models\OrderStatus;
use app\models\Product;
use Yii;
use app\models\Order;
use app\modules\admin\models\search\OrderSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;

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
            'label' => 'Редактировать',
            'url' => ['/'. Yii::$app->controller->module->id .'/'. Yii::$app->controller->id .'/'. Yii::$app->controller->action->id]
        ];

        $model = Order::findOne($id);
        if (empty($model))
            throw new \yii\web\NotFoundHttpException();

        $couponCode = $model->couponCode;
        $historyModel = new OrderHistory();
        $newProduct = new OrderProduct();

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

                if (empty($coupon)) {
                    $model->couponCode = null;
                }
            }

            $model->save();

            $model->recalculateTotal();

            if (!empty($this->_post['Order']['customerId'])) {
                Yii::$app->session->setFlash('save', 'Изменения успешно сохранены.');
                Yii::$app->session->setFlash('tab', 2);
            }
            if (!empty($this->_post['Order']['shippingId'])) {
                Yii::$app->session->setFlash('save', 'Изменения успешно сохранены.');
                Yii::$app->session->setFlash('tab', 5);
            }
            if (!empty($this->_post['Order']['paymentId'])) {
                Yii::$app->session->setFlash('save', 'Изменения успешно сохранены.');
                Yii::$app->session->setFlash('tab', 6);
            }

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
                'newProduct' => $newProduct,
            ]);
    }

    public function actionChangeProductQuantity()
    {
        $orderProduct = OrderProduct::findOne($this->_post['OrderProduct']['id']);

        if (empty($orderProduct))
            throw new NotFoundHttpException();

        if ($this->_post['OrderProduct']['productQuantity'] > 0) {
            $orderProduct->productQuantity = $this->_post['OrderProduct']['productQuantity'];
            $orderProduct->save();
        }

        if ($this->_post['OrderProduct']['productQuantity'] == 0) {
            $orderProduct->delete();
        }

        $orderProduct->order->recalculateTotal();

        Yii::$app->session->setFlash('save', 'Изменения успешно сохранены.');
        Yii::$app->session->setFlash('tab', 7);
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionChangeProductPrice()
    {
        $orderProduct = OrderProduct::findOne($this->_post['OrderProduct']['id']);

        if (empty($orderProduct))
            throw new NotFoundHttpException();

        if ($this->_post['OrderProduct']['productPrice'] > 0) {
            $orderProduct->productPrice = $this->_post['OrderProduct']['productPrice'];
            $orderProduct->save();
        }

        if ($this->_post['OrderProduct']['productPrice'] == 0) {
            $orderProduct->delete();
        }

        $orderProduct->order->recalculateTotal();

        Yii::$app->session->setFlash('save', 'Изменения успешно сохранены.');
        Yii::$app->session->setFlash('tab', 7);
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionAddProduct()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $model = new OrderProduct();

            $product = Product::find()->where(['sku' => $this->_post['OrderProduct']['productSku']])->one();

            if (empty($product)) {
                $model->addError('orderproduct-productsku', 'Товар не существует');
            }

//            return ActiveForm::validate($model);
            return $model->errors;
        }

        if (Yii::$app->request->isPost) {
            $product = Product::find()->where(['sku' => $this->_post['OrderProduct']['productSku']])->one();
            $model = new OrderProduct();
            $model->orderId = $this->_post['OrderProduct']['orderId'];
            $model->productId = $product->id;
            $model->productSku = $this->_post['OrderProduct']['productSku'];
            $model->productName = $product->name;
            $model->productQuantity = Product::DEFAULT_QUANTITY;
            $model->productPrice = $product->realPrice;
            $model->productIncomingPrice = $product->incomingPrice->price;
            $model->currencyCode = $product->currencyCode;
            $model->save();

            $model->order->recalculateTotal();

            Yii::$app->session->setFlash('save', 'Изменения успешно сохранены.');
            Yii::$app->session->setFlash('tab', 7);
            return $this->redirect(Yii::$app->request->referrer);
        }
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
            throw new NotFoundHttpException();
        }
    }
}
