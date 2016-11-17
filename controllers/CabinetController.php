<?php
/**
 *
 *
 * @version 1.0
 */
namespace app\controllers;

use app\models\Coupon;
use app\models\Customer;
use app\models\OrderCustomerInfo;
use app\models\OrderProcessForm;
use app\models\OrderProduct;
use app\models\OrderProductAttribute;
use app\models\OrderStatus;
use app\models\OrderTotal;
use app\models\User;
use Yii;
use app\models\Category;
use app\models\LoginForm;
use app\models\ShippingMethod;
use app\models\PaymentMethod;
use app\models\Order;
use \BW\Vkontakte as Vk;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;
class CabinetController extends AbstractController
{
    public $layout = 'main';

    public $facebook;

    public $vk;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function init()
    {
        parent::init();

        $this->facebook = new \Facebook\Facebook([
            'app_id' => Yii::$app->params['social']['facebook']['id'],
            'app_secret' => Yii::$app->params['social']['facebook']['secret'],
        ]);

        $this->vk = new Vk([
            'client_id' => Yii::$app->params['social']['vk']['id'],
            'client_secret' => Yii::$app->params['social']['vk']['secret'],
            'redirect_uri' => 'http://' . Yii::$app->getRequest()->serverName . '/social/vk',
        ]);

        Yii::$app->view->params['vk'] = $this->vk;
        Yii::$app->view->params['facebook'] = $this->facebook;
        Yii::$app->view->params['user'] = $this->user;

        Yii::$app->view->params['categories'] = Category::find()
            ->where(['isActive' => 1])
            ->andWhere(['level' => 0])
            ->orderBy('sortOrder', SORT_DESC)
            ->all();

        Yii::$app->view->params['login'] = new LoginForm();

        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => ' Мой кабинет',
            'url' => ['/cabinet']
        ];
    }

    /**
     * Главная.
     *
     * @return string
     */
    public function actionIndex()
    {
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => ' Личные данные',
            'url' => ['/cabinet']
        ];

        return $this->render(Yii::$app->controller->action->id, [
        ]);
    }

    public function actionChange()
    {
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => ' Личные данные',
            'url' => ['/cabinet']
        ];

        $model = Customer::findOne($this->user->id);
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()) && $model->address->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return array_merge(ActiveForm::validate($model), ActiveForm::validate($model->address));
        }

        if (
            $model->load(Yii::$app->request->post()) && $model->validate() &&
            $model->address->load(Yii::$app->request->post()) && $model->address->validate()
        ) {
            $model->save();
            $model->address->save();
            \Yii::$app->session->set('user', $model);
        }

        return $this->render(Yii::$app->controller->action->id, [
        ]);
    }

    public function actionViewed()
    {
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => ' Просмотренные товары',
            'url' => false
        ];

        $models = $this->getLastViewListProduct();
        $totalAmount = 0;

        foreach ($models as $model) {
            $totalAmount+= $model->realPrice;
        }

        return $this->render(Yii::$app->controller->action->id, [
            'totalAmount' => $totalAmount,
            'productsCount' => count($models),
            'viewProductList' => array_chunk($models, 5),
        ]);
    }

    public function actionOrders()
    {
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => ' Мои заказы',
            'url' => false
        ];

        return $this->render(Yii::$app->controller->action->id, [
        ]);
    }

    public function actionWaitingList()
    {
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => ' Лист ожидания',
            'url' => false
        ];

        return $this->render(Yii::$app->controller->action->id, [
        ]);
    }

    public function actionBasket()
    {
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => ' Корзина',
            'url' => false
        ];

        return $this->render(Yii::$app->controller->action->id, [
        ]);
    }

    public function actionWishList()
    {
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => ' Список желаний',
            'url' => false
        ];

        $model = Customer::findOne($this->user->id);
        $models = $model->wishProducts;
        $totalAmount = 0;

        foreach ($models as $model) {
            $totalAmount+= $model->realPrice;
        }

        return $this->render(Yii::$app->controller->action->id, [
            'totalAmount' => $totalAmount,
            'productsCount' => count($models),
            'wishProducts' => array_chunk($models, 5),
        ]);
    }

    public function actionOrderProcess()
    {
        if (empty($this->_basket->basketProducts))
            throw new \yii\web\NotFoundHttpException();

        $totalAmount = $this->_basket->productsPrice;

        $orderForm = new OrderProcessForm();

        $shippingMethods = ShippingMethod::find()->all();

        $paymentMethods = PaymentMethod::find()->all();

        $costumerGroupDiscount = $this->user->getDiscountByOrderAmount($totalAmount);

        $couponDiscount = null;

        if (Yii::$app->request->isPost && !empty($_POST['code'])) {
            $coupon = Coupon::find()
                ->where(
                    [
                        'code' => Yii::$app->request->post('code'),
                        'isActive' => 1,
                    ])
                ->andWhere('startTime <= :time AND endTime >= :time AND minimalOrderCost <= :orderAmount',
                    [
                        ':time' => date('Y-m-d H:i:s', time()),
                        ':orderAmount' => $totalAmount
                    ])
                ->one();
            $couponDiscount = $coupon->getDiscountByAmount($totalAmount);
        }

        return $this->render(Yii::$app->controller->action->id, [
                'coupon' => !empty($coupon) ? $coupon : null,
                'orderForm' => $orderForm,
                'costumerGroupDiscount' => $costumerGroupDiscount,
                'couponDiscount' => $couponDiscount,
                'totalDiscount' => $costumerGroupDiscount + (int) $couponDiscount,
                'totalAmount' => $totalAmount,
                'shippingMethods' => $shippingMethods,
                'paymentMethods' => $paymentMethods,
        ]);
    }

    public function actionOrderComplete()
    {
        if (empty($this->_basket->basketProducts))
            throw new \yii\web\NotFoundHttpException();

        $orderForm = new OrderProcessForm();

        if (Yii::$app->request->isAjax && $orderForm->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($orderForm);
        }

        if ($orderForm->load(Yii::$app->request->post()) && $orderForm->validate()) {
            $shippingMethod = ShippingMethod::findOne($orderForm->shipping);
            $paymentMethod = PaymentMethod::findOne($orderForm->payment);

            $totalAmount = $this->_basket->productsPrice;
            $totalDiscount = $this->user->getDiscountByOrderAmount($totalAmount);
            $totalIncrease = $shippingMethod->calculateIncrease($totalAmount);
            $totalIncrease+= $paymentMethod->calculateIncrease($totalAmount);
            if (!empty($orderForm->couponCode)) {
                $coupon = Coupon::find()->where(['code' => $orderForm->couponCode])->one();
                if (!empty($coupon)) {
                    $totalDiscount+= $coupon->getDiscountByAmount($totalAmount);
                }
            }

            $order = new Order();
            $order->customerId = $this->user->id;
            $order->shippingId = $orderForm->shipping;
            $order->paymentId = $orderForm->payment;
            $order->currencyCode = Order::CURRENCY_CODE;
            $order->orderStatus = OrderStatus::getDefault();
            $order->couponCode = $orderForm->couponCode;
            $order->save();

            $customerInfo = new OrderCustomerInfo();
            $customerInfo->orderId = $order->id;
            $customerInfo->сountryCode = $shippingMethod->countryCode;
            $customerInfo->address = $orderForm->address;
            $customerInfo->fullName = $orderForm->fullName;
            $customerInfo->phone1 = $orderForm->phone;
            $customerInfo->save();

            $orderTotal = new OrderTotal();
            $orderTotal->orderId = $order->id;
            $orderTotal->amount = $totalAmount + $totalIncrease - $totalDiscount;
            $orderTotal->currencyCode = Order::CURRENCY_CODE;
            $orderTotal->save();

            foreach ($this->_basket->basketProducts as $basketProduct) {
                $orderProduct = new OrderProduct();
                $orderProduct->orderId = $order->id;
                $orderProduct->productId = $basketProduct->productId;
                $orderProduct->productSku = $basketProduct->product->sku;
                $orderProduct->productName = $basketProduct->product->name;
                $orderProduct->productQuantity = $basketProduct->quantity;
                $orderProduct->productPrice = $basketProduct->product->price;
                $orderProduct->productIncomingPrice = $basketProduct->product->incomingPrice->price;
                $orderProduct->currencyCode = $basketProduct->product->currencyCode;
                $orderProduct->save();
                if (!empty($basketProduct->productAttributes)) {
                    foreach ($basketProduct->productAttributes as $basketProductAttribute) {
                        $orderProductAttribute = new OrderProductAttribute();
                        $orderProductAttribute->orderProductId = $orderProduct->id;
                        $orderProductAttribute->productOptionId = $basketProductAttribute->productOption->id;
                        $orderProductAttribute->productOptionName = $basketProductAttribute->productOption->name;
                        $orderProductAttribute->productOptionValueId = $basketProductAttribute->productOptionValue->id;
                        $orderProductAttribute->productOptionValueName = $basketProductAttribute->productOptionValue->name;
                        $orderProductAttribute->productAttributePrice = $basketProductAttribute->productOptionValue->price;
                        $orderProductAttribute->currencyCode = $basketProduct->product->currencyCode;
                        $orderProductAttribute->save();
                    }
                }
            }

            var_dump($orderForm); exit;
        }

        return $this->render(Yii::$app->controller->action->id, [
        ]);
    }
}
