<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "basket".
 *
 * @property string $id
 * @property string $sessionId
 * @property string $customerId
 * @property string $createTime
 *
 * @property Customer $customer
 * @property BasketProduct[] $basketProducts
 */
class Basket extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'basket';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sessionId', 'customerId'], 'required'],
            [['customerId'], 'integer'],
            [['createTime'], 'safe'],
            [['sessionId'], 'string', 'max' => 32],
            [['customerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customerId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sessionId' => 'Session ID',
            'customerId' => 'Customer ID',
            'createTime' => 'Create Time',
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
    public function getBasketProducts()
    {
        return $this->hasMany(BasketProduct::className(), ['basketId' => 'id']);
    }

    public function getProductsPrice()
    {
        $amount = 0;
        if (empty($this->basketProducts))
            return $amount;

        foreach ($this->basketProducts as $product)
        {
            $amount+= $product->product->realPrice;
            if (!empty($product->productAttributes)) {
                foreach ($product->productAttributes as $basketProductAttribute) {
                    $amount+= (int) $basketProductAttribute->productOptionValue->price;
                }
            }
        }

        return $amount;
    }
}
