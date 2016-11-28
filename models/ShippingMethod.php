<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shippingmethod".
 *
 * @property string $id
 * @property string $name
 * @property string $countryCode
 * @property string $description
 * @property string $imageFileName
 * @property string $price
 * @property string $requiredValue
 * @property string $insurancePercent
 * @property array $payments
 *
 * @property ShippingPaymentMethodRelation[] $shippingPaymentMethodRelations
 * @property PaymentMethod[] $paymentMethods
 */
class ShippingMethod extends \yii\db\ActiveRecord
{
    public $file;

    public $payments;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shippingmethod';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'countryCode'], 'required'],
            [['description'], 'string'],
            [['price', 'insurancePercent'], 'number'],
            [['file'], 'file', 'extensions' => 'gif, jpg, png'],
            [['name', 'imageFileName', 'requiredValue'], 'string', 'max' => 255],
            [['countryCode'], 'string', 'max' => 3],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'countryCode' => 'Код страны',
            'description' => 'Описание',
            'imageFileName' => 'Картинка',
            'payments' => 'Оплата',
            'price' => 'Стоимость',
            'insurancePercent' => 'Процент',
            'file' => 'Картинка',
            'requiredValue' => 'Дополнительное поле доставки',
        ];
    }

    public function calculateIncrease($amount)
    {
        if (!empty($this->price)) {
            return $this->price;
        } elseif (!empty($this->insurancePercent)) {
            return round($amount / 100 * $this->insurancePercent);
        }

        return 0;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingPaymentMethodRelations()
    {
        return $this->hasMany(ShippingPaymentMethodRelation::className(), ['shippingMethodId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentMethods()
    {
        return $this->hasMany(PaymentMethod::className(), ['id' => 'paymentMethodId'])->viaTable('shippingpaymentmethodrelation', ['shippingMethodId' => 'id']);
    }
}
