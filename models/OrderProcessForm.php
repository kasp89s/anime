<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class OrderProcessForm extends Model
{
    const SCENARIO_REGISTERED = 'REGISTERED';

    const SCENARIO_GUEST = 'GUEST';

    public $email;

    public $city;

    public $zip;

    public $fullName;

    public $phone;

    public $address;

    public $shipping;

    public $payment;

    public $comment;

    public $couponCode;

    public $loopAddress;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // email and password are both required
            [['fullName', 'phone', 'shipping', 'payment'], 'required'],
            [['address'], 'required', 'on' => self::SCENARIO_REGISTERED],
            [['email', 'city'], 'required', 'on' => self::SCENARIO_GUEST],
            [['loopAddress'], 'string'],
            [['comment'], 'string'],
            ['email', 'email', 'message' => 'Поле должно содержать корректный E-mail'],
            [['couponCode', 'city', 'zip', 'address'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => 'E-mail',
            'fullName' => 'Имя Фамилия',
            'phone' => 'Моб. телефон',
            'address' => 'Адрес',
            'loopAddress' => 'Адрес',
            'city' => 'Город',
            'zip' => 'Индекс',
            'shipping' => 'Доставка',
            'payment' => 'Оплата',
            'comment' => 'Добавить комментарий к заказу',
        ];
    }
}
