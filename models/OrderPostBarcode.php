<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "orderpostbarcode".
 *
 * @property integer $id          Идентификатор.
 * @property string  $orderId     Ссылка на заказ.
 * @property string  $createTime  Время создания.
 * @property string  $barcode     Штрихкод.
 * @property integer $isAvailable Флаг доступности.
 *
 * @property Order $order Модель заказа.
 *
 * @package app\models
 */
class OrderPostBarcode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orderpostbarcode';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'barcode'], 'required'],
            [['id', 'orderId', 'isAvailable'], 'integer'],
            [['createTime'], 'safe'],
            [['barcode'], 'string', 'max' => 45],
            [['orderId', 'barcode'], 'unique', 'targetAttribute' => ['orderId', 'barcode'], 'message' => 'The combination of Order ID and Barcode has already been taken.'],
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
            'createTime' => 'Create Time',
            'barcode' => 'Barcode',
            'isAvailable' => 'Is Available',
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
