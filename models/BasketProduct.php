<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "basketproduct".
 *
 * @property string $id
 * @property string $basketId
 * @property string $productId
 * @property string $quantity
 *
 * @property Product $product
 * @property Basket $basket
 * @property Basketproductattribute[] $basketproductattributes
 */
class BasketProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'basketproduct';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'basketId', 'productId', 'quantity'], 'required'],
            [['id', 'basketId', 'productId', 'quantity'], 'integer'],
            [['productId'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['productId' => 'id']],
            [['basketId'], 'exist', 'skipOnError' => true, 'targetClass' => Basket::className(), 'targetAttribute' => ['basketId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'basketId' => 'Basket ID',
            'productId' => 'Product ID',
            'quantity' => 'Quantity',
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
    public function getBasket()
    {
        return $this->hasOne(Basket::className(), ['id' => 'basketId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBasketProductAttributes()
    {
        return $this->hasMany(BasketProductAttribute::className(), ['basketProductId' => 'id']);
    }
}
