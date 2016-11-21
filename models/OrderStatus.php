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

    public function isAway($old)
    {
        if (
            $old->isDefault && $this->isChargeble ||
            $old->isDefault && $this->isPaid ||
            $old->isDefault && $this->isShipped ||
            $old->isDefault && $this->isPenalty ||
            $old->isDefault && $this->isFinished
        ) {
            return true;
        }

        return false;
    }

    public function isReturn($old)
    {
        if (
            $old->isChargeble && $this->isRestock ||
            $old->isPaid && $this->isRestock ||
            $old->isShipped && $this->isRestock ||
            $old->isFinished && $this->isRestock
        ) {
            return true;
        }

        return false;
    }

    public function isRecalculateGroup($old)
    {
        if (
            $old->isDefault && $this->isFinished ||
            $old->isChargeble && $this->isFinished ||
            $old->isShipped && $this->isFinished ||
            $old->isPaid && $this->isFinished ||
            $old->isPenalty && $this->isFinished
        ) {
            return true;
        }

        return false;
    }
}
