<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "productoptionvalue".
 *
 * @property string $id
 * @property string $productOptionId
 * @property string $name
 * @property string $price
 *
 * @property BasketProductAttribute[] $basketProductAttributes
 * @property Attribute[] $optionAttributes
 * @property Option $option
 */
class OptionValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'productoptionvalue';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['productOptionId', 'name'], 'required'],
            [['productOptionId'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['price'], 'string', 'max' => 45],
            [['productOptionId'], 'exist', 'skipOnError' => true, 'targetClass' => Option::className(), 'targetAttribute' => ['productOptionId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'productOptionId' => 'Product Option ID',
            'name' => 'Name',
            'price' => 'Price',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBasketProductAttributes()
    {
        return $this->hasMany(BasketProductAttribute::className(), ['productOptionValueId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptionAttributes()
    {
        return $this->hasMany(Attribute::className(), ['productOptionValueId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductOption()
    {
        return $this->hasOne(Option::className(), ['id' => 'productOptionId']);
    }
}
