<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "productproductspecificationrelation".
 *
 * @property string $id
 * @property string $productId
 * @property string $productSpecificationId
 * @property string $value
 * @property string $isSearch
 *
 * @property Product $product
 * @property Specification $specification
 */
class ProductSpecificationRelation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'productproductspecificationrelation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['productId', 'productSpecificationId'], 'required'],
            [['productId', 'productSpecificationId', 'isSearch'], 'integer'],
            [['value'], 'string'],
            [['productId'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['productId' => 'id']],
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
            'productId' => 'Product ID',
            'productSpecificationId' => 'Product Specification ID',
            'isSearch' => 'Поиск',
            'value' => 'Value',
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
    public function getSpecification()
    {
        return $this->hasOne(Specification::className(), ['id' => 'productSpecificationId']);
    }
}
