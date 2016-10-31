<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "productcategoryproductoptionrelation".
 *
 * @property string $id
 * @property string $productCategoryId
 * @property string $productOptionId
 *
 * @property Category $category
 * @property Option   $option
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
