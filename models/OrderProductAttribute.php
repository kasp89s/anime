<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "orderproductattribute".
 *
 * @property string $id                     Идентификатор.
 * @property string $orderProductId         Ссылка на продукт.
 * @property string $productOptionId        Ссылка на атрибут.
 * @property string $productOptionValueId   Ссылка на значения атрибута.
 * @property string $productOptionName      Имя атрибута.
 * @property string $productOptionValueName Название значения атрибута.
 * @property string $productAttributePrice  Стоимость атрибута.
 * @property string $currencyCode           Валюта.
 *
 * @property OptionValue  $optionValue  Модель значения опции.
 * @property OrderProduct $orderProduct Модель продукта в заказе.
 * @property Option       $option       Модель опции.
 *
 * @package app\models
 */
class OrderProductAttribute extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orderproductattribute';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orderProductId', 'productOptionId', 'productOptionValueId', 'productOptionName', 'productOptionValueName', 'currencyCode'], 'required'],
            [['orderProductId', 'productOptionId', 'productOptionValueId'], 'integer'],
            [['productAttributePrice'], 'number'],
            [['productOptionName', 'productOptionValueName'], 'string', 'max' => 255],
            [['currencyCode'], 'string', 'max' => 3],
            [['productOptionValueId'], 'exist', 'skipOnError' => true, 'targetClass' => OptionValue::className(), 'targetAttribute' => ['productOptionValueId' => 'id']],
            [['orderProductId'], 'exist', 'skipOnError' => true, 'targetClass' => OrderProduct::className(), 'targetAttribute' => ['orderProductId' => 'id']],
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
            'orderProductId' => 'Order Product ID',
            'productOptionId' => 'Product Option ID',
            'productOptionValueId' => 'Product Option Value ID',
            'productOptionName' => 'Product Option Name',
            'productOptionValueName' => 'Product Option Value Name',
            'productAttributePrice' => 'Product Attribute Price',
            'currencyCode' => 'Currency Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptionValue()
    {
        return $this->hasOne(OptionValue::className(), ['id' => 'productOptionValueId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderProduct()
    {
        return $this->hasOne(OrderProduct::className(), ['id' => 'orderProductId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOption()
    {
        return $this->hasOne(Option::className(), ['id' => 'productOptionId']);
    }
}
