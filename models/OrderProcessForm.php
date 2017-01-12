<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Форма заказа.
 *
 * @package app\models
 */
class OrderProcessForm extends Model
{
    /**
     * Сценарий для авторизированого пользователя.
     */
    const SCENARIO_REGISTERED = 'REGISTERED';

    /**
     * Сценарий для гостя.
     */
    const SCENARIO_GUEST = 'GUEST';

    /**
     * Почта.
     *
     * @var
     */
    public $email;

    /**
     * Город.
     *
     * @var
     */
    public $city;

    /**
     * Индекс.
     *
     * @var
     */
    public $zip;

    /**
     * ФИО.
     *
     * @var
     */
    public $fullName;

    /**
     * Телефон.
     *
     * @var
     */
    public $phone;

    /**
     * Адресс.
     *
     * @var
     */
    public $address;

    /**
     * Способ доставки.
     *
     * @var
     */
    public $shipping;

    /**
     * Способ оплаты.
     *
     * @var
     */
    public $payment;

    /**
     * Комментарий.
     *
     * @var
     */
    public $comment;

    /**
     * Код купона.
     *
     * @var
     */
    public $couponCode;

    /**
     * Новый адресс.
     *
     * @var
     */
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
