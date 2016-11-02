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
 * @property string $insurancePercent
 *
 * @property ShippingPaymentMethodRelation[] $shippingPaymentMethodRelations
 * @property PaymentMethod[] $paymentMethods
 */
class ShippingMethod extends \yii\db\ActiveRecord
{
    public $file;

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
            [['name', 'imageFileName'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'countryCode' => 'Country Code',
            'description' => 'Description',
            'imageFileName' => 'Image File Name',
            'price' => 'Price',
            'insurancePercent' => 'Insurance Percent',
            'file' => 'Картинка',
        ];
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