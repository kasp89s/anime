<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "productincomingprice".
 *
 * @property string $id           Идентификатор.
 * @property string $productId    Ссылка на продукт.
 * @property string $price        Стоимость.
 * @property string $currencyCode Код валюты.
 * @property string $time         Время.
 *
 * @property Product $product Модель продукта.
 *
 * @package app\models
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
