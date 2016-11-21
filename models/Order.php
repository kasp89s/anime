<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property string $id
 * @property string $customerId
 * @property string $shippingId
 * @property string $paymentId
 * @property string $currencyCode
 * @property string $orderStatus
 * @property string $couponCode
 * @property integer $createTime
 * @property integer $updateTime
 * @property integer $isFinished
 *
 * @property ShippingMethod $shipping
 * @property Customer $customer
 * @property PaymentMethod $payment
 * @property OrderCustomerInfo[] $customerInfo
 * @property OrderHistory[] $orderHistory
 * @property OrderPostBarcode[] $postBarcode
 * @property OrderProduct[] $products
 * @property OrderTotal[] $total
 * @property OrderStatus[] $status
 */
class Order extends \yii\db\ActiveRecord
{
    const CURRENCY_CODE = 'грн';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customerId', 'shippingId', 'paymentId', 'currencyCode', 'orderStatus'], 'required'],
            [['customerId', 'shippingId', 'paymentId', 'isFinished'], 'integer'],
            [['currencyCode'], 'string', 'max' => 3],
            [['orderStatus'], 'string', 'max' => 2],
            [['couponCode'], 'string', 'max' => 255],
            [['createTime', 'updateTime'], 'safe'],
            [['shippingId'], 'exist', 'skipOnError' => true, 'targetClass' => ShippingMethod::className(), 'targetAttribute' => ['shippingId' => 'id']],
            [['customerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customerId' => 'id']],
            [['paymentId'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentMethod::className(), 'targetAttribute' => ['paymentId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер заказа',
            'customerId' => 'Покупатель',
            'shippingId' => 'Shipping ID',
            'paymentId' => 'Payment ID',
            'currencyCode' => 'Currency Code',
            'orderStatus' => 'Статус заказа',
            'couponCode' => 'Купон',
            'createTime' => 'Дата заказа',
            'updateTime' => 'Изменен',
            'isFinished' => 'Закончен',
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipping()
    {
        return $this->hasOne(ShippingMethod::className(), ['id' => 'shippingId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayment()
    {
        return $this->hasOne(PaymentMethod::className(), ['id' => 'paymentId']);
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
    public function getCustomerInfo()
    {
        return $this->hasOne(OrderCustomerInfo::className(), ['orderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(OrderStatus::className(), ['statusCode' => 'orderStatus']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderHistory()
    {
        return $this->hasMany(OrderHistory::className(), ['orderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostBarcode()
    {
        return $this->hasOne(OrderPostBarcode::className(), ['orderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(OrderProduct::className(), ['orderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTotal()
    {
        return $this->hasOne(OrderTotal::className(), ['orderId' => 'id']);
    }

    /**
     * Возвращает форматированую дату.
     *
     * @param string $date
     *
     * @return bool|string
     */
    public static function getDate($date)
    {
        $time = strtotime($date);
        $monthData = [
            '01' => 'Января',
            '02' => 'Февраля',
            '03' => 'Марта',
            '04' => 'Апреля',
            '05' => 'Мая',
            '06' => 'Июня',
            '07' => 'Июля',
            '08' => 'Августа',
            '09' => 'Сентября',
            '10' => 'Октября',
            '11' => 'Ноября',
            '12' => 'Декабря'
        ];

        $month = $monthData[date('m', $time)];

        return date("d {$month} Y г.", $time);
    }
}
