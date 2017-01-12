<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "waitinglist".
 *
 * @property integer $id         Идентификатор.
 * @property string  $productId  Ссылка на продукт.
 * @property string  $customerId Ссылка на клиента.
 * @property string  $email      Почта.
 * @property string  $creteTime  Время создания.
 *
 * @property Customer $customer Клиент.
 * @property Product  $product  Продукт.
 *
 * @package app\models
 */
class WaitingList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'waitinglist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['productId', 'customerId'], 'required'],
            [['productId', 'customerId'], 'integer'],
            [['creteTime'], 'safe'],
            [['email'], 'string', 'max' => 255],
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
            'email' => 'Email',
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
