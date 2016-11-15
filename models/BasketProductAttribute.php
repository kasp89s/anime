<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "basketproductattribute".
 *
 * @property string $id
 * @property string $basketProductId
 * @property string $productOptionId
 * @property string $productOptionValueId
 *
 * @property BasketProduct $basketProduct
 * @property Option $productOption
 * @property OptionValue $productOptionValue
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
