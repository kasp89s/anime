<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "productoption".
 *
 * @property string $id
 * @property string $name
 *
 * @property BasketProductAttribute[] $basketProductAttributes
 * @property Attribute[] $optionAttributes
 * @property Category[] $categories
 * @property OptionValue[] $values
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
            'name' => 'Name',
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
