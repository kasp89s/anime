<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "productdiscount".
 *
 * @property string $id
 * @property string $description
 * @property integer $startTime
 * @property integer $endTime
 * @property string $type
 * @property string $value
 *
 * @property Product[] $products
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
