<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ordertotal".
 *
 * @property string $id
 * @property string $orderId
 * @property string $code
 * @property string $name
 * @property string $amount
 * @property string $currencyCode
 *
 * @property Order $order
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
            [['orderId', 'amount', 'currecnyCode'], 'required'],
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
