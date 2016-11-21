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
            'orderStatus' => 'Статус',
            'comment' => 'Коментарий',
            'isCustomerNotified' => 'Оповещен',
            'createTime' => 'Время',
            'createUserId' => 'Создал',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'orderId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreateUser()
    {
        return $this->hasOne(User::className(), ['id' => 'createUserId']);
    }
}
