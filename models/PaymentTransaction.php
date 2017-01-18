<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "payment_transaction".
 *
 * @property string $id              Идентификатор.
 * @property string $customerId      Ссылка на клиента.
 * @property string $orderId         Ссылка на заказ.
 * @property string $paymentMethodId Ссылка на платежный метод.
 * @property double $amount          Сумма.
 * @property string $dateCreated     Создан.
 * @property string $dateComplete    Завершен.
 * @property string $status          Статус.
 *
 * @property Paymentmethod $paymentMethod Модель способа оплаты.
 * @property Customer      $customer      Модель клиента.
 * @property Order         $order         Модель заказа.
 */
class PaymentTransaction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customerId', 'orderId', 'paymentMethodId', 'amount'], 'required'],
            [['customerId', 'orderId', 'paymentMethodId'], 'integer'],
            [['amount'], 'number'],
            [['dateCreated', 'dateComplete'], 'safe'],
            [['status'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Идентификатор',
            'customerId' => 'Customer ID',
            'orderId' => 'Order ID',
            'paymentMethodId' => 'Payment Method ID',
            'amount' => 'Amount',
            'dateCreated' => 'Date Created',
            'dateComplete' => 'Date Complete',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentMethod()
    {
        return $this->hasOne(Paymentmethod::className(), ['id' => 'paymentMethodId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customerId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'orderId']);
    }
}
