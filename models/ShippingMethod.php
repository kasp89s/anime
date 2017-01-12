<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "shippingmethod".
 *
 * @property string $id               Идентификатор.
 * @property string $name             Название.
 * @property string $countryCode      Код страны.
 * @property string $description      Описание.
 * @property string $imageFileName    Название картинки.
 * @property string $price            Стоимость.
 * @property string $requiredValue    Значение.
 * @property string $lopped           Урезаные данные по доставке.
 * @property string $insurancePercent Процент.
 * @property array  $payments         Оплата.
 *
 * @property ShippingPaymentMethodRelation[] $shippingPaymentMethodRelations Модель связи с платенжными методами.
 * @property PaymentMethod[]                 $paymentMethods                 Модель платежного метода.
 *
 * @package app\models
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
            [['lopped'], 'safe'],
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
            'lopped' => 'Урезаные данные по доставке',
        ];
    }

    /**
     * Возвращает наценку по достаке.
     *
     * @param float $amount Сумма заказа.
     *
     * @return float|int|string
     */
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
