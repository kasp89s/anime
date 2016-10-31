<?php
/**
 * Базовый контроллер содержит общие методы и параметры.
 *
 * @version 1.0
 */
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\LoginForm;
use app\models\RegisterForm;

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

		if (!\Yii::$app->user->isGuest) {
			$this->user = User::find()->where(['id' => \Yii::$app->user->id])->one();
		}
    }

    public function actionLogin()
    {
        if (\Yii::$app->user->isGuest) {
            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                return $this->goHome();
            }
            echo \yii\helpers\BaseJson::encode($model->getErrors());
        }

        Yii::$app->end();
    }

	public function actionCheck()
    {
		$model = new RegisterForm(['scenario' => RegisterForm::SCENARIO_CHECK]);
		
		if($model->load(Yii::$app->request->post()) && $model->validate()) {
			Yii::$app->end();
		}

		echo \yii\helpers\BaseJson::encode($model->getErrors());
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
        Yii::$app->user->logout(false);

        return $this->goHome();
    }
}
