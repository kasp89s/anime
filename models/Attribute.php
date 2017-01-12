<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "productattribute".
 *
 * @property string $id                   Идентификатор.
 * @property string $productId            Ссылка на товар.
 * @property string $productOptionId      Ссылка на опцию.
 * @property string $productOptionValueId Ссылка на значение опции.
 * @property string $price                Стоимость.
 * @property string $quantityInStock      Количество.
 *
 * @property OptionValue $optionValue     Модель значения опции.
 * @property Product     $product         Модель товара.
 * @property Option      $option          Модель опции.
 *
 * @package app\models
 */
class Attribute extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'productattribute';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['productId', 'productOptionId', 'productOptionValueId'], 'required'],
            [['productId', 'productOptionId', 'productOptionValueId', 'quantityInStock'], 'integer'],
            [['price'], 'number'],
            [['productOptionValueId'], 'exist', 'skipOnError' => true, 'targetClass' => OptionValue::className(), 'targetAttribute' => ['productOptionValueId' => 'id']],
            [['productId'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['productId' => 'id']],
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
            'productId' => 'Product ID',
            'productOptionId' => 'Product Option ID',
            'productOptionValueId' => 'Product Option Value ID',
            'price' => 'Price',
            'quantityInStock' => 'Quantity In Stock',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptionValue()
    {
        return $this->hasOne(OptionValue::className(), ['id' => 'productOptionValueId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'productId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOption()
    {
        return $this->hasOne(Option::className(), ['id' => 'productOptionId']);
    }
}
