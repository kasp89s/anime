<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "paymentmethod".
 *
 * @property string $id
 * @property string $name
 * @property string $countryCode
 * @property string $description
 * @property string $imageFileName
 * @property string $price
 * @property string $feePercent
 *
 * @property ShippingPaymentMethodRelation[] $shippingPaymentMethodRelations
 * @property ShippingMethod[] $shippingMethods
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
            'name' => 'Name',
            'countryCode' => 'Country Code',
            'description' => 'Description',
            'imageFileName' => 'Image File Name',
            'price' => 'Price',
            'feePercent' => 'Fee Percent',
            'file' => 'Картинка',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingpaymentmethodrelations()
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
