<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "productdiscount".
 *
 * @property string  $id          Идентификатор.
 * @property string  $description Описание.
 * @property integer $startTime   Время начала.
 * @property integer $endTime     Время окончания.
 * @property string  $type        Тип скидки.
 * @property string  $value       Значение.
 *
 * @property Product[] $products Модель продукта.
 *
 * @package app\models
 */
class Discount extends \yii\db\ActiveRecord
{

    const TYPE_VALUE = 'value';

    const TYPE_PERCENT = 'percent';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'productdiscount';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'type'], 'string'],
            [['startTime', 'endTime'], 'safe'],
            [['value'], 'required'],
            [['value'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Описание',
            'startTime' => 'Начало',
            'endTime' => 'Окончание',
            'type' => 'Тип',
            'value' => 'Значение',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['productDisountId' => 'id']);
    }
}
