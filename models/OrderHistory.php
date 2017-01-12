<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "orderhistory".
 *
 * @property string  $id                 Идентификатор.
 * @property string  $orderId            Ссылка на заказ.
 * @property string  $orderStatus        Статус.
 * @property string  $comment            Комментарий.
 * @property integer $isCustomerNotified Флаг уведомления пользователя о смене в заказе.
 * @property string  $createTime         Время создания.
 * @property integer $createUserId       Ссылка на админа.
 *
 * @property Order $order Модель заказа.
 *
 * @package app\models
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
