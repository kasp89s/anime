<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "coupon".
 *
 * @property string $id
 * @property string $code
 * @property string $description
 * @property integer $startTime
 * @property integer $endTime
 * @property string $type
 * @property string $value
 * @property string $minimalOrderCost
 * @property integer $isActive
 * @property string $createTime
 * @property string $updateTime
 * @property string $createUserId
 * @property string $updateUserId
 *
 * @property User $updateUser
 * @property User $createUser
 */
class Coupon extends \yii\db\ActiveRecord
{
    const TYPE_PERCENT = 'percent';

    const TYPE_VALUE = 'value';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'coupon';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'value', 'createUserId', 'startTime', 'endTime'], 'required'],
            [['description', 'type'], 'string'],
            [['isActive', 'createUserId', 'updateUserId'], 'integer'],
            [['value', 'minimalOrderCost'], 'number'],
            [['createTime','startTime', 'endTime', 'updateTime'], 'safe'],
            [['code'], 'string', 'max' => 255],
            [['code'], 'unique'],
            [['updateUserId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updateUserId' => 'id']],
            [['createUserId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['createUserId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Код',
            'description' => 'Описание',
            'startTime' => 'С',
            'endTime' => 'По',
            'type' => 'Тип',
            'value' => 'Значение',
            'minimalOrderCost' => 'Минимаьный заказ',
            'createTime' => 'Создан',
            'updateTime' => 'Обновлен',
            'createUserId' => 'Создал',
            'updateUserId' => 'Обновил',
            'isActive' => 'Активность',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdateUser()
    {
        return $this->hasOne(User::className(), ['id' => 'updateUserId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreateUser()
    {
        return $this->hasOne(User::className(), ['id' => 'createUserId']);
    }

    public function getDiscountByAmount($amount)
    {
        if ($this->type == self::TYPE_PERCENT) {
            return round($amount / 100 * $this->value);
        }

        if ($this->type == self::TYPE_VALUE) {
            return $this->value;
        }

        return 0;
    }
}
