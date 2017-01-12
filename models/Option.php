<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "productoption".
 *
 * @property string $id   Идентификатор.
 * @property string $name Название.
 *
 * @property BasketProductAttribute[] $basketProductAttributes Модель атрибута продукта в корзине.
 * @property Attribute[]              $optionAttributes        Модель атрибута.
 * @property Category[]               $categories              Модель категории.
 * @property OptionValue[]            $values                  Модель значения атрибута.
 *
 * @package app\models
 */
class Option extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'productoption';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
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
            'name' => 'Название',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBasketProductAttributes()
    {
        return $this->hasMany(BasketProductAttribute::className(), ['productOptionId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptionAttributes()
    {
        return $this->hasMany(Attribute::className(), ['productOptionId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'productCategoryId'])->viaTable('productcategoryproductoptionrelation', ['productOptionId' => 'id']);

    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValues()
    {
        return $this->hasMany(OptionValue::className(), ['productOptionId' => 'id']);
    }
}
