<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "productcategoryproductspecificationrelation".
 *
 * @property string $id
 * @property string $productCategoryId
 * @property string $productSpecificationId
 *
 * @property Category $category
 * @property Specification $specification
 */
class CategorySpecificationRelation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'productcategoryproductspecificationrelation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['productCategoryId', 'productSpecificationId'], 'required'],
            [['productCategoryId', 'productSpecificationId'], 'integer'],
            [['productCategoryId'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['productCategoryId' => 'id']],
            [['productSpecificationId'], 'exist', 'skipOnError' => true, 'targetClass' => Specification::className(), 'targetAttribute' => ['productSpecificationId' => 'id']],
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
            'productSpecificationId' => 'Product Specification ID',
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
    public function getProductSpecification()
    {
        return $this->hasOne(Specification::className(), ['id' => 'productSpecificationId']);
    }
}
