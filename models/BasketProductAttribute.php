<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "basketproductattribute".
 *
 * @property string $id                   Идентификатор.
 * @property string $basketProductId      Ссыдка на продукт в корзине.
 * @property string $productOptionId      Ссылка на опцию.
 * @property string $productOptionValueId Ссылка на значение опции.
 *
 * @property BasketProduct $basketProduct      Модель продукта в корзине.
 * @property Option        $productOption      Модель опции.
 * @property OptionValue   $productOptionValue Модель значения опции.
 *
 * @package app\models
 */
class BasketProductAttribute extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'basketproductattribute';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['basketProductId', 'productOptionId', 'productOptionValueId'], 'required'],
            [['id', 'basketProductId', 'productOptionId', 'productOptionValueId'], 'integer'],
            [['basketProductId'], 'exist', 'skipOnError' => true, 'targetClass' => Basketproduct::className(), 'targetAttribute' => ['basketProductId' => 'id']],
            [['productOptionId'], 'exist', 'skipOnError' => true, 'targetClass' => Option::className(), 'targetAttribute' => ['productOptionId' => 'id']],
            [['productOptionValueId'], 'exist', 'skipOnError' => true, 'targetClass' => OptionValue::className(), 'targetAttribute' => ['productOptionValueId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'basketProductId' => 'Basket Product ID',
            'productOptionId' => 'Product Option ID',
            'productOptionValueId' => 'Product Option Value ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBasketProduct()
    {
        return $this->hasOne(Basketproduct::className(), ['id' => 'basketProductId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductOption()
    {
        return $this->hasOne(Option::className(), ['id' => 'productOptionId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductOptionValue()
    {
        return $this->hasOne(OptionValue::className(), ['id' => 'productOptionValueId']);
    }
}
