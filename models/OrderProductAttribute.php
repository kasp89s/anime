<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orderproductattribute".
 *
 * @property string $id
 * @property string $orderProductId
 * @property string $productOptionId
 * @property string $productOptionValueId
 * @property string $productOptionName
 * @property string $productOptionValueName
 * @property string $productAttributePrice
 * @property string $currencyCode
 *
 * @property OptionValue $optionValue
 * @property OrderProduct $orderProduct
 * @property Option $option
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
            [['id', 'orderProductId', 'productOptionId', 'productOptionValueId', 'productOptionName', 'productOptionValueName', 'currencyCode'], 'required'],
            [['id', 'orderProductId', 'productOptionId', 'productOptionValueId'], 'integer'],
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
    public function getptionValue()
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
