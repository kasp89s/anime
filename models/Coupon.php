<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "coupon".
 *
 * @property string  $id               Идентификатор.
 * @property string  $code             Код купона.
 * @property string  $description      Описание.
 * @property integer $startTime        Время начала.
 * @property integer $endTime          Время окончания.
 * @property string  $type             Тип.
 * @property string  $value            Значение.
 * @property string  $minimalOrderCost Минимальная сумма заказа.
 * @property integer $isActive         Флаг активности.
 * @property string  $createTime       Время создания.
 * @property string  $updateTime       Время обновления.
 * @property string  $createUserId  Ссылка на администратора который создал запись.
 * @property string  $updateUserId  Ссылка на администратора который обновил запись.
 *
 * @package app\models
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

    /**
     * Возвращает скидку по купону исходя из стоимости.
     *
     * @param float|int|string $amount Стоимость.
     *
     * @return float|int|string
     */
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
