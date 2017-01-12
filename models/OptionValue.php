<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "productoptionvalue".
 *
 * @property string $id              Идентификатор.
 * @property string $productOptionId Ссылка на опцию.
 * @property string $name            Название.
 * @property string $price           Стоимость.
 *
 * @property BasketProductAttribute[] $basketProductAttributes Модель атрибута продукта в корзине.
 * @property Attribute[]              $optionAttributes        Модель атрибута.
 * @property Option                   $option                  Модель опции.
 *
 * @package app\models
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
            'name' => 'Название',
            'price' => 'Цена',
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
     * @return integer
     */
    public function getOptionAttributesCount()
    {
        return $this->hasMany(Attribute::className(), ['productOptionValueId' => 'id'])->count();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductOption()
    {
        return $this->hasOne(Option::className(), ['id' => 'productOptionId']);
    }
}
