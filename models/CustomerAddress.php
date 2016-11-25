<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customeraddress".
 *
 * @property string $id
 * @property string $customerId
 * @property string $countryCode
 * @property string $city
 * @property string $zip
 * @property string $address
 * @property integer $isPrimary
 *
 * @property Customer $customer
 */
class CustomerAddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customeraddress';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customerId', 'address'], 'required'],
            [['customerId', 'isPrimary'], 'integer'],
            [['countryCode'], 'string', 'max' => 3],
            [['city'], 'string', 'max' => 100],
            [['zip'], 'string', 'max' => 10],
            [['address'], 'string', 'max' => 255],
            [['customerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customerId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
//            'id' => 'ID',
//            'customerId' => 'Customer ID',
            'countryCode' => 'Код страны',
            'city' => 'Гогод',
            'zip' => 'Индекс',
            'address' => 'Адрес',
            'isPrimary' => 'Is Primary',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customerId']);
    }
}
