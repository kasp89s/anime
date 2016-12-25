<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ordercustomerinfo".
 *
 * @property string $id
 * @property string $orderId
 * @property string $countryCode
 * @property string $city
 * @property string $zip
 * @property string $address
 * @property string $fullName
 * @property string $phone1
 * @property string $phone2
 * @property string $shippingValue
 *
 * @property Order $order
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
