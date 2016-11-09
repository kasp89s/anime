<?php
/**
 * Базовый контроллер содержит общие методы и параметры.
 *
 * @version 1.0
 */
namespace app\controllers;

use app\models\Customer;
use app\models\CustomerAddress;
use app\models\InfoPage;
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

    public function init()
    {
        $this->session = Yii::$app->session;
        if (!$this->session->isActive) {
            $this->session->open();
        }

		if (\Yii::$app->session->get('user')) {
			$this->user = \Yii::$app->session->get('user');
		}

		foreach (InfoPage::find()->all() as $page) {
            Yii::$app->view->params['pages'][$page->code] = $page;
        }

        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => 'Главная',
            'url' => ['/']
        ];
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

    public function actionRegister()
    {
        $model = new RegisterForm(['scenario' => RegisterForm::SCENARIO_REGISTER]);

        if($model->load(Yii::$app->request->post()) && $model->register()) {
				$mailer = new \PHPMailer();
				$mailer->setFrom(Yii::$app->params['adminEmail']);
				$mailer->addAddress($model->_user->email);
				$mailer->isHTML(true);

				$mailer->Subject = \yii\helpers\Url::base();
				$mailer->Body    = $this->renderPartial('emailTemplates/registrationMail', [
						'username' => $model->_user->username,
						'email' => $model->_user->email,
						'password' => $model->password,
					]);
				if(!$mailer->send()) {
					throw new Exception('Mailer Error: ' . $mailer->ErrorInfo);
				}
				
			echo \yii\helpers\BaseJson::encode(['success' => true]);
			Yii::$app->end();
        }

        echo \yii\helpers\BaseJson::encode($model->getErrors());
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

        $models = Product::find()->where(['id' => $currentList])->all();

        return $models;
    }
}
