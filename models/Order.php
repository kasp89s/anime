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
 * @property OrderPostBarcode[] $orderPostBarcodes
 * @property OrderProduct[] $orderProducts
 * @property OrderTotal[] $orderTotals
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
            'id' => 'ID',
            'customerId' => 'Customer ID',
            'shippingId' => 'Shipping ID',
            'paymentId' => 'Payment ID',
            'currencyCode' => 'Currency Code',
            'orderStatus' => 'Order Status',
            'couponCode' => 'Coupon Code',
            'createTime' => 'Create Time',
            'updateTime' => 'Update Time',
            'isFinished' => 'Is Finished',
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
    public function getOrderHistory()
    {
        return $this->hasMany(OrderHistory::className(), ['orderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderPostBarcode()
    {
        return $this->hasMany(OrderPostBarcode::className(), ['orderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderProducts()
    {
        return $this->hasMany(OrderProduct::className(), ['orderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderTotal()
    {
        return $this->hasOne(OrderTotal::className(), ['orderId' => 'id']);
    }
}
