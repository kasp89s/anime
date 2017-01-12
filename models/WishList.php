<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "wishlist".
 *
 * @property integer $id         Идентификатор.
 * @property string  $productId  Ссылка на продукт.
 * @property string  $customerId Ссылка на клиента.
 * @property string  $creteTime  Время создания.
 *
 * @property Customer $customer Модель клиента.
 * @property Product  $product  Модель продукта.
 *
 * @package app\models
 */
class WishList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wishlist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['productId', 'customerId'], 'required'],
            [['id', 'productId', 'customerId'], 'integer'],
            [['creteTime'], 'safe'],
            [['customerId', 'productId'], 'unique', 'targetAttribute' => ['customerId', 'productId'], 'message' => 'The combination of Product ID and Customer ID has already been taken.'],
            [['customerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customerId' => 'id']],
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
            'customerId' => 'Customer ID',
            'creteTime' => 'Crete Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customerId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'productId']);
    }
}
