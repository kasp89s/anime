<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "basketproduct".
 *
 * @property string $id        Идентификатор.
 * @property string $basketId  Ссылка на корзину.
 * @property string $productId Ссылка на продукт.
 * @property string $quantity  Количество.
 *
 * @property Product                  $product           Модель продукта.
 * @property Basket                   $basket            Модель корзины.
 * @property BasketProductAttribute[] $productAttributes Модель атрибутов товара в корзине.
 *
 * @package app\models
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
            [['basketId', 'productId', 'quantity'], 'required'],
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
    public function getProductAttributes()
    {
        return $this->hasMany(BasketProductAttribute::className(), ['basketProductId' => 'id']);
    }
}
