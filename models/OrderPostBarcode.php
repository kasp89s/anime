<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orderpostbarcode".
 *
 * @property integer $id
 * @property string $orderId
 * @property string $createTime
 * @property string $barcode
 * @property integer $isAvailable
 *
 * @property Order $order
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
