<?php
/**
 *
 *
 * @version 1.0
 */
namespace app\controllers;

use app\models\BasketProduct;
use app\models\Coupon;
use app\models\Customer;
use app\models\CustomerAddress;
use app\models\CustomerPhone;
use app\models\OrderCustomerInfo;
use app\models\OrderHistory;
use app\models\OrderProcessForm;
use app\models\OrderProduct;
use app\models\OrderProductAttribute;
use app\models\OrderStatus;
use app\models\OrderTotal;
use app\models\Product;
use app\models\QuickOrderForm;
use app\models\User;
use app\models\WaitingList;
use Yii;
use app\models\Category;
use app\models\LoginForm;
use app\models\ShippingMethod;
use app\models\PaymentMethod;
use app\models\Order;
use \BW\Vkontakte as Vk;
use yii\base\Model;
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

    public function beforeAction($event)
    {
        if (empty($this->user) && !in_array(\Yii::$app->controller->action->id, ['basket', 'viewed', 'order-checkout', 'order-checkout', 'order-complete']))
            \Yii::$app->response->redirect(['/']);

        return parent::beforeAction($event);
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

        $purchasedProducts = OrderProduct::find()
            ->joinWith('order')
            ->joinWith('order.status')
            ->joinWith('product')
            ->where([
                'order.customerId' => $this->user->id,
                'orderstatus.isFinished' => 1,
            ])
            ->all();
        return $this->render(Yii::$app->controller->action->id, [
            'purchasedProducts' => $purchasedProducts
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
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return array_merge(ActiveForm::validate($model));
        }

        if (
            $model->load(Yii::$app->request->post()) && $model->validate()
        ) {
            Model::loadMultiple($model->phones, Yii::$app->request->post());
            foreach ($model->phones as $phone) {
                $phone->save();
            }
            Model::loadMultiple($model->address, Yii::$app->request->post());
            foreach ($model->address as $address) {
                $address->save();
            }
            $post = Yii::$app->request->post();

            if (!empty($post['phones'])) {
                foreach ($post['phones'] as $phone) {
                    if (empty($phone)) continue;

                    $phoneModel = new CustomerPhone();
                    $phoneModel->customerId = $this->user->id;
                    $phoneModel->phone = $phone;
                    $phoneModel->save();
                }
            }

            if (!empty($post['address'])) {
                foreach ($post['address'] as $index => $address) {
                    if (!is_numeric($index)) continue;

                    $phoneModel = new CustomerAddress();
                    $phoneModel->customerId = $this->user->id;
                    $phoneModel->city = $address['city'];
                    $phoneModel->address = $address['address'];
                    $phoneModel->zip = $address['zip'];
                    $phoneModel->save();
                }
            }

            $model->save();
            $model = Customer::findOne($this->user->id);
            \Yii::$app->session->set('user', $model);
            \Yii::$app->response->redirect(['cabinet/index']);
        }

        return $this->render(Yii::$app->controller->action->id, [
            'model' => $model
        ]);
    }

    public function actionViewed()
    {
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => ' Просмотренные товары',
            'url' => false
        ];

        $currentList = json_decode(Yii::$app->request->cookies->getValue('LastView'), true);

        if (empty($currentList))
            return [];

        $query = Product::find()
            ->where(['product.id' => $currentList])
            ->joinWith('discount')
            ->joinWith('marker');

        if (!empty($_GET['time']))
            $query->orderBy('product.updateTime desc');

        if (!empty($_GET['price_d']))
            $query->orderBy('product.price desc');

        if (!empty($_GET['price_a']))
            $query->orderBy('product.price asc');

        if (!empty($_GET['stock']))
            $query->orderBy('product.quantityInStock desc');

        if (!empty($_GET['sold']))
            $query->orderBy('product.quantityOfSold desc');

        $models = $query->all();
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

        $orders = Order::find()
            ->where(['customerId' => $this->user->id])
            ->joinWith('shipping')
            ->joinWith('payment')
            ->joinWith('customer')
            ->joinWith('status')
            ->joinWith('postBarcode')
            ->joinWith('customerInfo')
            ->joinWith('products')
            ->joinWith('products.product')
            ->joinWith('products.productAttributes')
            ->joinWith('total')
            ->orderBy('createTime desc')->all();

        return $this->render(Yii::$app->controller->action->id, [
            'orders' => $orders
        ]);
    }

    public function actionWaitingList()
    {
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => ' Лист ожидания',
            'url' => false
        ];

        $query = WaitingList::find()->where(
            [
                'customerId' => $this->user->id
            ]
        );

        if (!empty($_GET['price_d']))
            $query->orderBy('product.price desc');

        if (!empty($_GET['price_a']))
            $query->orderBy('product.price asc');

        if (!empty($_GET['stock']))
            $query->orderBy('product.quantityInStock desc');

        if (!empty($_GET['sold']))
            $query->orderBy('product.quantityOfSold desc');

        $models = $query->all();
        $totalAmount = 0;

        foreach ($models as $model) {
            $totalAmount+= $model->product->realPrice;
        }

        return $this->render(Yii::$app->controller->action->id, [
            'totalAmount' => $totalAmount,
            'productsCount' => count($models),
            'viewProductList' => array_chunk($models, 5),
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

        $sortColumn = 'product.id';
        $sortType = SORT_DESC;

        if (!empty($_GET['time'])) {
            $sortColumn = 'product.updateTime';
            $sortType = SORT_DESC;
        }

        if (!empty($_GET['price_d'])) {
            $sortColumn = 'product.price';
            $sortType = SORT_DESC;
        }

        if (!empty($_GET['price_a'])) {
            $sortColumn = 'product.price';
            $sortType = SORT_ASC;
        }

        if (!empty($_GET['stock'])) {
            $sortColumn = 'product.quantityInStock';
            $sortType = SORT_DESC;
        }

        if (!empty($_GET['sold'])) {
            $sortColumn = 'product.quantityOfSold';
            $sortType = SORT_DESC;
        }

        $model = Customer::findOne($this->user->id);
        $models = $model->getWishProducts($sortColumn, $sortType)->all();
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

    public function actionOrderCheckout()
    {
        if (empty($this->_basket->basketProducts))
            throw new \yii\web\NotFoundHttpException();

        $totalAmount = $this->_basket->productsPrice;

        $orderForm = new OrderProcessForm();

        $shippingMethods = ShippingMethod::find()->all();

        $paymentMethods = PaymentMethod::find()->all();

        $costumerGroupDiscount = !empty($this->user) ? $this->user->getDiscountByOrderAmount($totalAmount) : 0;

        $couponDiscount = null;

        $couponError = null;

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
            if (!empty($coupon)) {
                $couponDiscount = $coupon->getDiscountByAmount($totalAmount);
            } else {
                $couponError = 'Введеный код купона не актуален!';
            }
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
                'couponError' => $couponError,
        ]);
    }

    public function actionOrderComplete()
    {
        if (empty($this->_basket->basketProducts))
            throw new \yii\web\NotFoundHttpException();

        $orderForm = new OrderProcessForm(
            ['scenario' => !empty($this->user) ? OrderProcessForm::SCENARIO_REGISTERED : OrderProcessForm::SCENARIO_GUEST]
        );

        if (Yii::$app->request->isAjax && $orderForm->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ActiveForm::validate($orderForm);
        }

        if ($orderForm->load(Yii::$app->request->post()) && $orderForm->validate()) {

            $post = Yii::$app->request->post();
            if (!empty($post['newPhone'])) {
                $phoneModel = new CustomerPhone();
                $phoneModel->customerId = $this->user->id;
                $phoneModel->phone = $post['newPhone'];
                $phoneModel->save();
                $orderForm->phone = $phoneModel->phone;
            }

            if (!empty($post['newAddress']['address'])) {
                $AddressModel = new CustomerAddress();
                $AddressModel->customerId = $this->user->id;
                $AddressModel->city = $post['newAddress']['city'];
                $AddressModel->address = $post['newAddress']['address'];
                $AddressModel->zip = $post['newAddress']['zip'];
                $AddressModel->save();
            } elseif(!empty($orderForm->address) && !empty($this->user)) {
                $AddressModel = CustomerAddress::findOne($orderForm->address);
            } elseif (empty($this->user)) {
                $AddressModel = (object) [
                    'city' => $orderForm->city,
                    'address' => $orderForm->address,
                    'zip' => $orderForm->zip,
                ];
            }

            $shippingMethod = ShippingMethod::findOne($orderForm->shipping);
            $paymentMethod = PaymentMethod::findOne($orderForm->payment);

            if ($shippingMethod->lopped == 1) {
                if (!empty($post['newAddress']['city'])) {
                    $AddressModel = (object) [
                        'city' => $post['newAddress']['city'],
                        'address' => null,
                        'zip' => null,
                    ];
                } elseif(!empty($orderForm->loopAddress) && !empty($this->user)) {
                    $AddressModel = CustomerAddress::findOne($orderForm->loopAddress);
                    $AddressModel->address = null;
                    $AddressModel->zip = null;
                } elseif (empty($this->user)) {
                    $AddressModel = (object) [
                        'city' => $orderForm->city,
                        'address' => null,
                        'zip' => null,
                    ];
                }
            }

            $totalAmount = $this->_basket->productsPrice;
            $totalDiscount = !empty ($this->user) ? $this->user->getDiscountByOrderAmount($totalAmount) : 0;
            $totalIncrease = $shippingMethod->calculateIncrease($totalAmount);
            $totalIncrease+= $paymentMethod->calculateIncrease($totalAmount);
            if (!empty($orderForm->couponCode)) {
                $coupon = Coupon::find()->where(['code' => $orderForm->couponCode])->one();
                if (!empty($coupon)) {
                    $totalDiscount+= $coupon->getDiscountByAmount($totalAmount);
                }
            }

            $order = new Order();
            $order->customerId = !empty ($this->user) ? $this->user->id : Customer::DEFAULT_CUSTOMER_ID;
            $order->shippingId = $orderForm->shipping;
            $order->paymentId = $orderForm->payment;
            $order->currencyCode = Order::CURRENCY_CODE;
            $order->orderStatus = OrderStatus::getDefault();
            $order->couponCode = $orderForm->couponCode;
            $order->createTime = date('Y-m-d H:i:s', time());
            $order->save();

            $customerInfo = new OrderCustomerInfo();
            $customerInfo->orderId = $order->id;
            $customerInfo->countryCode = $shippingMethod->countryCode;
            $customerInfo->city = $AddressModel->city;
            $customerInfo->address = $AddressModel->address;
            $customerInfo->zip = $AddressModel->zip;
            $customerInfo->fullName = $orderForm->fullName;
            $customerInfo->phone1 = $orderForm->phone;
            $customerInfo->shippingValue = !empty($post['shippingValue']) ? $post['shippingValue'] : '';
            $customerInfo->save();

            $orderTotal = new OrderTotal();
            $orderTotal->orderId = $order->id;
            $orderTotal->amount = $totalAmount + $totalIncrease - $totalDiscount;
            $orderTotal->currencyCode = Order::CURRENCY_CODE;
            $orderTotal->save();

            $orderHistory = new OrderHistory();
            $orderHistory->orderId = $order->id;
            $orderHistory->orderStatus = $order->orderStatus;
            $orderHistory->isCustomerNotified = 1;
            $orderHistory->createTime = date('Y-m-d H:i:s', time());
            $orderHistory->createUserId = User::DEFAULT_USER;
            $orderHistory->comment = !empty($orderForm->comment) ? $orderForm->comment : null;
            $orderHistory->save();

            foreach ($this->_basket->basketProducts as $basketProduct) {
                $orderProduct = new OrderProduct();
                $orderProduct->orderId = $order->id;
                $orderProduct->productId = $basketProduct->productId;
                $orderProduct->productSku = $basketProduct->product->sku;
                $orderProduct->productName = $basketProduct->product->name;
                $orderProduct->productQuantity = $basketProduct->quantity;
                $orderProduct->productPrice = $basketProduct->product->realPrice;
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
                $orderProduct->productPrice = $orderProduct->priceWithAttributes;
                $orderProduct->save();
            }

            $email = !empty($this->user) ? $this->user->email : $orderForm->email;
            $this->sendEmail($email, Yii::$app->params['newOrderSubject'], $this->renderPartial('emailTemplates/new-order', ['order' => $order]));
            BasketProduct::deleteAll('basketId = :id', [':id' => $this->_basket->id]);
        }

        return $this->render(Yii::$app->controller->action->id, [
            'order' => $order
        ]);
    }

    public function actionQuickOrder()
    {
        $model = new QuickOrderForm();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if (!$model->load(Yii::$app->request->post())) {
            return $this->goHome();
        }

        $shipping = ShippingMethod::find()->one();
        $payment = PaymentMethod::find()->one();
        $product = Product::findOne($model->productId);

        $order = new Order();
        $order->customerId = !empty ($this->user) ? $this->user->id : Customer::DEFAULT_CUSTOMER_ID;
        $order->shippingId = $shipping->id;
        $order->paymentId = $payment->id;
        $order->currencyCode = Order::CURRENCY_CODE;
        $order->orderStatus = OrderStatus::getDefault();
        $order->couponCode = null;
        $order->createTime = date('Y-m-d H:i:s', time());
        $order->save();

        $customerInfo = new OrderCustomerInfo();
        $customerInfo->orderId = $order->id;
        $customerInfo->countryCode = $shipping->countryCode;
        $customerInfo->address = 'не указан';
        $customerInfo->fullName = $model->name;
        $customerInfo->phone1 = $model->phone;
        $customerInfo->save();

        $orderTotal = new OrderTotal();
        $orderTotal->orderId = $order->id;
        $orderTotal->amount = $product->realPrice;
        $orderTotal->currencyCode = Order::CURRENCY_CODE;
        $orderTotal->save();

        $orderHistory = new OrderHistory();
        $orderHistory->orderId = $order->id;
        $orderHistory->orderStatus = $order->orderStatus;
        $orderHistory->isCustomerNotified = !empty ($this->user) ? 1 : 0;
        $orderHistory->createTime = date('Y-m-d H:i:s', time());
        $orderHistory->createUserId = User::DEFAULT_USER;
        $orderHistory->save();

        $orderProduct = new OrderProduct();
        $orderProduct->orderId = $order->id;
        $orderProduct->productId = $product->id;
        $orderProduct->productSku = $product->sku;
        $orderProduct->productName = $product->name;
        $orderProduct->productQuantity = Product::DEFAULT_QUANTITY;
        $orderProduct->productPrice = $product->realPrice;
        $orderProduct->productIncomingPrice = $product->incomingPrice->price;
        $orderProduct->currencyCode = $product->currencyCode;
        $orderProduct->save();

        if (!empty ($this->user)) {
            $this->sendEmail($this->user->email, Yii::$app->params['newOrderSubject'], $this->renderPartial('emailTemplates/new-order', ['order' => $order]));
        }

        return $this->render('order-complete', [
            'order' => $order
        ]);
    }
}
