<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "orderstatus".
 *
 * @property integer $id          Идентификатор.
 * @property string  $statusCode  Статус.
 * @property string  $name        Название.
 * @property integer $isDefault   По умолчанию.
 * @property integer $isChargeble Подлежащий оплате.
 * @property integer $isPaid      Оплаченный.
 * @property integer $isShipped   Доставлен.
 * @property integer $isRestock   Возврат.
 * @property integer $isPenalty   Заблокирован.
 * @property integer $isFinished  Законченый.
 *
 * @package app\models
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

    /**
     * Возвращает статус по умолчанию.
     *
     * @return mixed
     */
    public static function getDefault()
    {
        return self::find()->where(['isDefault' => 1])->one()->statusCode;
    }

    /**
     * Возвращает флаг отгрузки заказа.
     *
     * @param OrderStatus $old Модель старого статуса.
     *
     * @return bool
     */
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

    /**
     * Возвращает флаг возврата заказа.
     *
     * @param OrderStatus $old Модель старого статуса.
     *
     * @return bool
     */
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

    /**
     * Возвращает флаг необходимости пересчета группы скидки.
     *
     * @param OrderStatus $old Модель старого статуса.
     *
     * @return bool
     */
    public function isRecalculateGroup($old)
    {
        if (
            $old->isDefault && $this->isFinished ||
            $old->isChargeble && $this->isFinished ||
            $old->isShipped && $this->isFinished ||
            $old->isPaid && $this->isFinished ||
            $old->isPenalty && $this->isFinished ||
            $old->isFinished && $this->isDefault ||
            $old->isFinished && $this->isChargeble ||
            $old->isFinished && $this->isShipped ||
            $old->isFinished && $this->isPaid ||
            $old->isFinished && $this->isPenalty

        ) {
            return true;
        }

        return false;
    }
}
