<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Customer;

/**
 * LoginForm is the model behind the login form.
 */
class RecoverForm extends Model
{
    public $email;

    public $customer;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            ['email', 'email', 'message' => 'Поле должно содержать корректный E-mail'],
            ['email', 'findUser'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => 'E-mail',
        ];
    }

    /**
     * Finds user by [[email]]
     *
     * @return User|null
     */
    public function findUser()
    {
        $this->customer = Customer::findByUsername($this->email);

        if (empty($this->customer)) {
            $this->addError('email', 'Не верный E-mail');

            return false;
        }

        return true;
    }
}
