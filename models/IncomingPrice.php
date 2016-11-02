<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "productincomingprice".
 *
 * @property string $id
 * @property string $productId
 * @property string $price
 * @property string $currencyCode
 * @property string $time
 *
 * @property Product $product
 */
class IncomingPrice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'productincomingprice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['productId'], 'required'],
            [['productId'], 'integer'],
            [['price'], 'number'],
            [['time'], 'safe'],
            [['currencyCode'], 'string', 'max' => 3],
            [['productId'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['productId' => 'id']],
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
            'price' => 'Цена',
            'currencyCode' => 'Валюта',
            'time' => 'Время',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'productId']);
    }
}
