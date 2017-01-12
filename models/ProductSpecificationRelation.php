<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "productproductspecificationrelation".
 *
 * @property string $id                     Идентификатор.
 * @property string $productId              Ссылка на продукт.
 * @property string $productSpecificationId Ссылка на спецификацию.
 * @property string $value                  Значение.
 * @property string $isSearch               Доступен к поиску.
 *
 * @property Product       $product         Модель продукта.
 * @property Specification $specification   Модель спецификации.
 *
 * @package app\models
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
