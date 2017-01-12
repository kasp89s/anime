<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "paymentmethod".
 *
 * @property string $id            Идентификатор.
 * @property string $name          Название.
 * @property string $countryCode   Код страны.
 * @property string $description   Описание.
 * @property string $imageFileName Имя картинки.
 * @property string $price         Стоимость.
 * @property string $feePercent    Процент скидки.
 *
 * @property ShippingPaymentMethodRelation[] $shippingPaymentMethodRelations Модель связи со способом доставки.
 * @property ShippingMethod[]                $shippingMethods                Модель способа доставки.
 *
 * @package app\models
 */
class PaymentMethod extends \yii\db\ActiveRecord
{
    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'paymentmethod';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['price', 'feePercent'], 'number'],
            [['name'], 'string', 'max' => 45],
            [['countryCode'], 'string', 'max' => 3],
            [['imageFileName'], 'string', 'max' => 255],
            [['file'], 'file', 'extensions' => 'gif, jpg, png'],
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
            'price' => 'Стоимость',
            'feePercent' => 'Процент',
            'file' => 'Картинка',
        ];
    }

    public function calculateIncrease($amount)
    {
        if (!empty($this->price)) {
            return $this->price;
        } elseif (!empty($this->feePercent)) {
            return round($amount / 100 * $this->feePercent);
        }

        return 0;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingPaymentMethodRelations()
    {
        return $this->hasMany(ShippingPaymentMethodRelation::className(), ['paymentMethodId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingMethods()
    {
        return $this->hasMany(ShippingMethod::className(), ['id' => 'shippingMethodId'])->viaTable('shippingpaymentmethodrelation', ['paymentMethodId' => 'id']);
    }
}
