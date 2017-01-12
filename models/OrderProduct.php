<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "orderproduct".
 *
 * @property string  $id                   Идентификатор.
 * @property string  $orderId              Ссылка на заказ.
 * @property string  $productId            Ссылка на продукт.
 * @property string  $productSku           Артикул продукта.
 * @property string  $productName          Название продукта.
 * @property string  $productQuantity      Количество.
 * @property string  $productPrice         Стоимость продукта.
 * @property string  $productIncomingPrice Входящая цена.
 * @property integer $isPreOrder           Флаг предзаказа.
 * @property string  $currencyCode         Валюта.
 *
 * @property Product                 $product           Модель продукта.
 * @property Order                   $order             Модель заказа.
 * @property OrderProductAttribute[] $productAttributes Модель атрибута продукта.
 *
 * @package app\models
 */
class OrderProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orderproduct';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orderId', 'productId', 'productSku', 'productName', 'productQuantity', 'currencyCode'], 'required'],
            [['orderId', 'productId', 'productQuantity', 'isPreOrder'], 'integer'],
            [['productPrice', 'productIncomingPrice'], 'number'],
            [['productSku'], 'string', 'max' => 255],
            [['productName'], 'string', 'max' => 500],
            [['currencyCode'], 'string', 'max' => 3],
            [['productId'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['productId' => 'id']],
            [['orderId'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['orderId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'orderId' => 'Order ID',
            'productId' => 'Product ID',
            'productSku' => 'Артикул',
            'productName' => 'Название',
            'productQuantity' => 'Количество',
            'productPrice' => 'Цена',
            'productIncomingPrice' => 'Product Incoming Price',
            'isPreOrder' => 'Предзаказ',
            'currencyCode' => 'Валюта',
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
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'orderId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductAttributes()
    {
        return $this->hasMany(OrderProductAttribute::className(), ['orderProductId' => 'id']);
    }

    /**
     * Возвращает стоимость с учетом наценки атрибутов.
     *
     * @return string
     */
    public function getPriceWithAttributes()
    {
        $price = $this->productPrice;

        if (!empty($this->productAttributes)) {
            foreach ($this->productAttributes as $attribute) {
                $price+= $attribute->productAttributePrice;
            }
        }

        return $price;
    }
}
