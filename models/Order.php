<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property string $id
 * @property string $customerId
 * @property string $shppingInfo
 * @property string $paymentInfo
 * @property string $currencyCode
 * @property string $orderStatus
 * @property string $couponCode
 * @property integer $createTime
 * @property integer $updateTime
 * @property integer $isFinished
 *
 * @property Customer $customer
 * @property OrderCustomerInfo[] $customerInfo
 * @property OrderHistory[] $orderHistories
 * @property OrderPostBarcode[] $orderPostBarcode
 * @property OrderProduct[] $orderProducts
 * @property OrderTotal[] $orderTotal
 */
class Order extends \yii\db\ActiveRecord
{
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
            [['customerId', 'shppingInfo', 'paymentInfo', 'currencyCode', 'orderStatus', 'createTime'], 'required'],
            [['customerId', 'createTime', 'updateTime', 'isFinished'], 'integer'],
            [['shppingInfo', 'paymentInfo'], 'string'],
            [['currencyCode'], 'string', 'max' => 3],
            [['orderStatus'], 'string', 'max' => 2],
            [['couponCode'], 'string', 'max' => 255],
            [['customerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customerId' => 'id']],
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
            'shppingInfo' => 'Shpping Info',
            'paymentInfo' => 'Payment Info',
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
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customerId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerInfos()
    {
        return $this->hasMany(OrderCustomerInfo::className(), ['orderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderHistories()
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
