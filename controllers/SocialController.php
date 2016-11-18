<?php

namespace app\controllers;

use app\models\Customer;
use app\models\CustomerAddress;
use app\models\CustomerGroup;
use yii\base\ErrorException;
use app\models\User;
use Yii;
use Facebook;
use \BW\Vkontakte as Vk;

class SocialController extends AbstractController
{
    public $facebook;

    public $vk;

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
    }

    public function actionVk()
    {
        if (isset($_GET['code'])) {
            $this->vk->authenticate();

            $user = $this->vk->api('users.get', [
                    'user_id' => $this->vk->getUserId(),
                    'fields' => [
                        'nickname',
                        'photo_50',
                        'city',
                        'sex',
                    ],
                ]);

            $this->auth([
                    'id' => (string) $user[0]['id'],
                    'name' => !empty($user[0]['nickname']) ? $user[0]['nickname'] : $user[0]['first_name'],
                    'email' => null,
                ], 'vk');
        }
    }

    public function actionFacebook()
    {
        $helper = $this->facebook->getRedirectLoginHelper();

        try {
            $accessToken = $helper->getAccessToken();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        if (! isset($accessToken)) {
            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $helper->getError() . "\n";
                echo "Error Code: " . $helper->getErrorCode() . "\n";
                echo "Error Reason: " . $helper->getErrorReason() . "\n";
                echo "Error Description: " . $helper->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
            exit;
        }

        $response = $this->facebook->get('/me?fields=id,name,email', $accessToken->getValue());
        $user = $response->getGraphUser();
        $this->auth([
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
        ], 'facebook');
    }

    private function auth($params, $method)
    {
        $group = CustomerGroup::find()->where([
            'isDefault' => 1
        ])->one();

        if (empty($group))
            throw new ErrorException('Группа пользователей по умолчанию не назначена');

        $customer = Customer::find()
            ->where(['authID' => $params['id']])
            ->andWhere(['authMethod' => $method])
            ->one();

        if (empty($customer)) {
            $customer = new Customer();
            $customer->email = $params['email'];
            $customer->password = md5($this->password);
            $customer->customerGroupId = $group->id;
            $customer->isActive = 1;
            $customer->registrationIp = $_SERVER['REMOTE_ADDR'];
            $customer->authID = (string) $params['id'];
            $customer->authMethod = $method;

            if (!$customer->validate()) {
                var_dump($customer->getErrors());
                exit;
            } else {
                $customer->save();

                $customerAddress = new CustomerAddress();
                $customerAddress->customerId = $customer->id;
                $customerAddress->save(false);
            }
        }

        \Yii::$app->session->set('user', $customer);
        return $this->goHome();
    }
}
