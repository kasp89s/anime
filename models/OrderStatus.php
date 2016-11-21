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
            [['statusCode', 'name'], 'required'],
            [['isDefault', 'isChargeble', 'isPaid', 'isShipped', 'isRestock', 'isPenalty', 'isFinished'], 'integer'],
            [['statusCode'], 'string', 'max' => 2],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'statusCode' => 'Код',
            'name' => 'Название',
            'isDefault' => 'По умолчанию',
            'isChargeble' => 'Подлежащий оплате',
            'isPaid' => 'Оплаченный',
            'isShipped' => 'Доставлен',
            'isRestock' => 'Возврат',
            'isPenalty' => 'Заблокирован',
            'isFinished' => 'Законченый',
        ];
    }

    public static function getDefault()
    {
        return self::find()->where(['isDefault' => 1])->one()->statusCode;
    }
}
