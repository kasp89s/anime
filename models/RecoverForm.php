<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Customer;

/**
 * Модель формы восстановления пароля.
 *
 * @package app\models
 */
class RecoverForm extends Model
{
    /**
     * Почта.
     *
     * @var
     */
    public $email;

    /**
     * Клиент.
     *
     * @var
     */
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
