<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "customergroup".
 *
 * @property string  $id                    Идентификатор.
 * @property string  $name                  Название.
 * @property string  $description           Описание.
 * @property double  $groupDiscount         Скидка группы.
 * @property integer $isAutomaticGroup      Флаг возможности автоматического перехода в группу.
 * @property integer $isActive              Флаг активности.
 * @property integer $isDefault             Группа устанавливается по умолчанию.
 * @property double  $groupAccumulatedLimit Необходимая сумма заказов для применения группы к клиету.
 *
 * @property Customer[] $customers Модель.
 *
 * @package app\models
 */
class CustomerGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customergroup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['groupDiscount', 'groupAccumulatedLimit'], 'number'],
            [['isAutomaticGroup', 'isActive', 'isDefault'], 'integer'],
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
            'name' => 'Группа',
            'description' => 'Описание',
            'groupDiscount' => 'Скидка',
            'isAutomaticGroup' => 'Авто',
            'isActive' => 'Активен',
            'isDefault' => 'По умолчанию',
            'groupAccumulatedLimit' => 'Необходимая сумма',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customer::className(), ['customerGroupId' => 'id']);
    }
}
