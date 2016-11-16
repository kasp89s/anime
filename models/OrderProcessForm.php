<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class OrderProcessForm extends Model
{
    public $fullName;

    public $phone;

    public $address;

    public $shipping;

    public $payment;

    public $comment;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // email and password are both required
            [['fullName', 'phone', 'address', 'shipping', 'payment'], 'required'],
            [['comment'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fullName' => 'Имя Фамилия',
            'phone' => 'Моб. телефон',
            'address' => 'Адрес',
            'shipping' => 'Доставка',
            'payment' => 'Оплата',
            'comment' => 'Добавить комментарий к заказу',
        ];
    }
}
