<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "ordertotal".
 *
 * @property string $id           Идентификатор.
 * @property string $orderId      Ссылка на заказ.
 * @property string $code         Код.
 * @property string $name         Название.
 * @property string $amount       Стоимость.
 * @property string $currencyCode Валюта.
 *
 * @property Order $order Модель заказа.
 *
 * @package app\models
 */
class OrderTotal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ordertotal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orderId', 'amount', 'currencyCode'], 'required'],
            [['orderId'], 'integer'],
            [['amount'], 'number'],
            [['code', 'name'], 'string', 'max' => 255],
            [['currencyCode'], 'string', 'max' => 3],
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
            'code' => 'Code',
            'name' => 'Name',
            'amount' => 'Amount',
            'currencyCode' => 'Currency Code',
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
