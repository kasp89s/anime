<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "productcategoryrelation".
 *
 * @property string $productId         Ссылка на продукт.
 * @property string $productCategoryId Ссылка на категорию.
 *
 * @property Product  $product   Модель продукта.
 * @property Category $category  Модель котегории.
 *
 * @package app\models
 */
class ProductCategoryRelation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'productcategoryrelation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['productId', 'productCategoryId'], 'required'],
            [['productId', 'productCategoryId'], 'integer'],
            [['productCategoryId', 'productId'], 'unique', 'targetAttribute' => ['productCategoryId', 'productId'], 'message' => 'The combination of Product ID and Product Category ID has already been taken.'],
            [['productId'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['productId' => 'id']],
            [['productCategoryId'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['productCategoryId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'productId' => 'Product ID',
            'productCategoryId' => 'Product Category ID',
        ];
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
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'productCategoryId']);
    }
}
