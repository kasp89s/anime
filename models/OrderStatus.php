<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orderstatus".
 *
 * @property integer $id
 * @property string $statusCode
 * @property string $name
 * @property integer $isDefault
 * @property integer $isChargeble
 * @property integer $isPaid
 * @property integer $isShipped
 * @property integer $isRestock
 * @property integer $isPenalty
 * @property integer $isFinished
 */
class OrderStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orderstatus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'statusCode', 'name'], 'required'],
            [['id', 'isDefault', 'isChargeble', 'isPaid', 'isShipped', 'isRestock', 'isPenalty', 'isFinished'], 'integer'],
            [['statusCode'], 'string', 'max' => 2],
            [['name'], 'string', 'max' => 255],
            [['isDefault'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'statusCode' => 'Status Code',
            'name' => 'Name',
            'isDefault' => 'Is Default',
            'isChargeble' => 'Is Chargeble',
            'isPaid' => 'Is Paid',
            'isShipped' => 'Is Shipped',
            'isRestock' => 'Is Restock',
            'isPenalty' => 'Is Penalty',
            'isFinished' => 'Is Finished',
        ];
    }

    public static function getDefault()
    {
        return self::find()->where(['isDefault' => 1])->one()->statusCode;
    }
}
