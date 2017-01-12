<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "shippingpaymentmethodrelation".
 *
 * @property string $shippingMethodId Ссылка на метод доставки.
 * @property string $paymentMethodId  Ссылка на платежный метод.
 *
 * @property PaymentMethod  $paymentMethod  Модель платежного метода.
 * @property ShippingMethod $shippingMethod Модель метода доставки.
 *
 * @package app\models
 */
class ShippingPaymentMethodRelation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shippingpaymentmethodrelation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shippingMethodId', 'paymentMethodId'], 'required'],
            [['shippingMethodId', 'paymentMethodId'], 'integer'],
            [['shippingMethodId', 'paymentMethodId'], 'unique', 'targetAttribute' => ['shippingMethodId', 'paymentMethodId'], 'message' => 'The combination of Shipping Method ID and Payment Method ID has already been taken.'],
            [['paymentMethodId'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentMethod::className(), 'targetAttribute' => ['paymentMethodId' => 'id']],
            [['shippingMethodId'], 'exist', 'skipOnError' => true, 'targetClass' => ShippingMethod::className(), 'targetAttribute' => ['shippingMethodId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'shippingMethodId' => 'Shipping Method ID',
            'paymentMethodId' => 'Payment Method ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentMethod()
    {
        return $this->hasOne(PaymentMethod::className(), ['id' => 'paymentMethodId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingMethod()
    {
        return $this->hasOne(ShippingMethod::className(), ['id' => 'shippingMethodId']);
    }
}
