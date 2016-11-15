<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orderhistory".
 *
 * @property string $id
 * @property string $orderId
 * @property string $orderStatus
 * @property string $comment
 * @property integer $isCustomerNotified
 * @property string $createTime
 * @property integer $createUserId
 *
 * @property Order $order
 */
class OrderHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orderhistory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orderId', 'orderStatus', 'createUserId'], 'required'],
            [['orderId', 'isCustomerNotified', 'createUserId'], 'integer'],
            [['comment'], 'string'],
            [['createTime'], 'safe'],
            [['orderStatus'], 'string', 'max' => 2],
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
            'orderStatus' => 'Order Status',
            'comment' => 'Comment',
            'isCustomerNotified' => 'Is Customer Notified',
            'createTime' => 'Create Time',
            'createUserId' => 'Create User ID',
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
