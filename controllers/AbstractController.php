<?php
/**
 * Базовый контроллер содержит общие методы и параметры.
 *
 * @version 1.0
 */
namespace app\controllers;

use app\models\Basket;
use app\models\Customer;
use app\models\CustomerAddress;
use app\models\InfoPage;
use app\models\RecoverForm;
use app\models\RegisterForm;
use Yii;
use yii\web\Controller;
use app\models\LoginForm;
use app\models\Product;
use yii\web\Response;
use yii\widgets\ActiveForm;

$phpMailer = Yii::getAlias('@app/vendor/phpmailer/PHPMailer.php');
require_once($phpMailer);

class AbstractController extends Controller {

    public $session = false;

    public $user = false;

    public $_theme = '';

    public $_sessionId;

    public $_basket;

    public function init()
    {
		if (\Yii::$app->session->get('user')) {
			$this->user = \Yii::$app->session->get('user');
		}

		foreach (InfoPage::find()->all() as $page) {
            Yii::$app->view->params['pages'][$page->code] = $page;
        }

        $this->instanceBasketSession();

        if (!empty($this->user->id)) {
            // Заходит авторизированый пользователь.
            $this->_basket = Basket::find()
                ->where(['customerId' => $this->user->id])
                ->joinWith('basketProducts')
                ->joinWith('basketProducts.productAttributes')
                ->joinWith('basketProducts.product')
                ->joinWith('basketProducts.product.discount')
                ->one();

            // Если пользователь зашол с другого компютера и авторизировался синхронизируем его корзину.
            if (!empty($this->_basket) && $this->_sessionId != $this->_basket->sessionId) {
                Yii::$app->response->cookies->add(new \yii\web\Cookie([
                        'name' => '_sid',
                        'value' => $this->_basket->sessionId,
                ]));

                // И удалим корзину гостя. Перенеся все что в ней было в корзину пользователя.
                Basket::synchronization($this->_sessionId, $this->_basket);

                $this->_sessionId = $this->_basket->sessionId;
            }

            // Если пользователь авторизирован но у него нет корзины значить он новый.
            if (empty($this->_basket)) {
                // Создаем корзину.
                $this->_basket = new Basket();
                $this->_basket->customerId = $this->user->id;
                $this->_basket->sessionId = md5(time());
                $this->_basket->save();

                // Обновим сессию.
                Yii::$app->response->cookies->add(new \yii\web\Cookie([
                        'name' => '_sid',
                        'value' => $this->_basket->sessionId,
                    ]));

                // И удалим корзину гостя. Перенеся все что в ней было в корзину пользователя.
                Basket::synchronization($this->_sessionId, $this->_basket);

                $this->_sessionId = $this->_basket->sessionId;
            }
        } else {
            // Заходит гость.
            $this->_basket = Basket::find()
                ->where(['sessionId' => $this->_sessionId])
                ->joinWith('basketProducts')
                ->joinWith('basketProducts.productAttributes')
                ->joinWith('basketProducts.product')
                ->joinWith('basketProducts.product.discount')
                ->one();

            if (empty($this->_basket)) {
                $this->_basket = new Basket();
                $this->_basket->customerId = Customer::DEFAULT_CUSTOMER_ID;
                $this->_basket->sessionId = $this->_sessionId;
                $this->_basket->save();
            }
        }

        Yii::$app->view->params['basket'] = $this->_basket;

        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => 'Главная',
            'url' => ['/']
        ];
    }

    protected function instanceBasketSession()
    {
        $this->_sessionId = Yii::$app->request->cookies->getValue('_sid');

        if (empty($this->_sessionId)) {
            $this->_sessionId = md5(time());
            Yii::$app->response->cookies->add(new \yii\web\Cookie([
                    'name' => '_sid',
                    'value' => $this->_sessionId,
                ]));
        }
    }

    public function actionLogin()
    {
        if (!\Yii::$app->session->get('user')) {
            $model = new LoginForm();
            if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }

            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                return $this->goHome();
            }

        }

        return $this->goHome();
    }

    public function actionRegistration()
    {
        $model = new RegisterForm();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ActiveForm::validate($model);
        }

        if($model->load(Yii::$app->request->post()) && $model->validate()) {
            $customer = $model->register();

            $this->sendEmail(
                $model->email,
                Yii::$app->params['NewRegistrationSubject'],
                $this->renderPartial('emailTemplates/registration', ['customer' => $customer])
            );

            return $this->render(Yii::$app->controller->action->id, [
                'customer' => $customer
            ]);
        }
    }

    public function actionRegistrationConfirm($code)
    {
        $model = Customer::find()->where(['code' => $code])->one();
        if (empty($model))
            throw new \yii\web\NotFoundHttpException();

        $model->code = null;
        $model->isActive = 1;

        $model->save();

        return $this->render(Yii::$app->controller->action->id, []);
    }

    public function actionRecover()
    {
        $model = new RecoverForm();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $newPassword = uniqid();
            $model->customer->password = md5($newPassword);
            $model->customer->save();

            $this->sendEmail(
                $model->email,
                Yii::$app->params['RecoverSubject'],
                $this->renderPartial('emailTemplates/recover', ['newPassword' => $newPassword])
            );

            return $this->render(Yii::$app->controller->action->id, [
                    'newPassword' => $newPassword
            ]);
        }
    }

    /**
     * Exit.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        \Yii::$app->session->remove('user');

        return $this->goHome();
    }

    protected function sendEmail($email, $subject, $body)
    {
        $mailer = new \PHPMailer();
        $mailer->setFrom(Yii::$app->params['adminEmail']);
        $mailer->addAddress($email);
        $mailer->isHTML(true);

        $mailer->Subject = $subject;
        $mailer->Body    = $body;
        if(!$mailer->send()) {
            error_log($mailer->ErrorInfo);
        }
    }

    /**
     * Устанавливает продукт как просмотреный.
     *
     * @param $productId Иедентификатор продукта.
     */
    protected function setLastViewProduct($productId)
    {
        $currentList = json_decode(Yii::$app->request->cookies->getValue('LastView'), true);

        if (empty($currentList)) {
            $currentList = json_encode([$productId => $productId]);
        } else {
            $currentList[$productId] = $productId;
            $currentList = json_encode($currentList);
        }

        Yii::$app->response->cookies->add(new \yii\web\Cookie([
                'name' => 'LastView',
                'value' => $currentList,
            ]));
    }

    /**
     * Возвращает последние просмотреные продукты.
     *
     * @return $this|array
     */
    protected function getLastViewListProduct()
    {
        $currentList = json_decode(Yii::$app->request->cookies->getValue('LastView'), true);

        if (empty($currentList))
            return [];

        $models = Product::find()->where(['product.id' => $currentList])->joinWith('discount')->limit(6)->all();

        return $models;
    }
}
