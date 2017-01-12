<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "productcategoryproductoptionrelation".
 *
 * @property string $id                Идентификатор.
 * @property string $productCategoryId Ссылка на категорию.
 * @property string $productOptionId   Ссылка на опцию.
 *
 * @property Category $category Модель категории.
 * @property Option   $option   Модель опции.
 *
 * @package app\models
 */
class CategoryOptionRelation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'productcategoryproductoptionrelation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['productCategoryId', 'productOptionId'], 'required'],
            [['productCategoryId', 'productOptionId'], 'integer'],
            [['productCategoryId'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['productCategoryId' => 'id']],
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
            'productCategoryId' => 'Product Category ID',
            'productOptionId' => 'Product Option ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'productCategoryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductOption()
    {
        return $this->hasOne(Option::className(), ['id' => 'productOptionId']);
    }
}
