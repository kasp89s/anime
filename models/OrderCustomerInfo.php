<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "ordercustomerinfo".
 *
 * @property string $id            Идентификатор.
 * @property string $orderId       Ссылка на заказ.
 * @property string $countryCode   Код страны.
 * @property string $city          Город.
 * @property string $zip           Индекс.
 * @property string $address       Адресс.
 * @property string $fullName      ФИО.
 * @property string $phone1        Телефон.
 * @property string $phone2        Телефон.
 * @property string $shippingValue Дополнительная информация о доставке.
 *
 * @property Order $order
 *
 * @package app\models
 */
class OrderCustomerInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ordercustomerinfo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orderId', 'countryCode', 'fullName', 'phone1'], 'required'],
            [['orderId'], 'integer'],
            [['countryCode'], 'string', 'max' => 3],
            [['city', 'address', 'fullName', 'shippingValue'], 'string', 'max' => 255],
            [['zip'], 'string', 'max' => 10],
            [['phone1'], 'string', 'max' => 15],
            [['phone2'], 'string', 'max' => 45],
            [['orderId'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['orderId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'orderId' => 'Order ID',
            'countryCode' => 'Код страны',
            'city' => 'Город',
            'zip' => 'Индекс',
            'address' => 'Адресс',
            'fullName' => 'Имя Фамилия',
            'phone1' => 'Моб. телефон',
            'phone2' => 'Доп. телефон',
            'shippingValue' => 'Значение атрибута доставки',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'orderId']);
    }
}
