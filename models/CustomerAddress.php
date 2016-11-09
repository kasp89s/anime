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
 * @property string $fullName
 * @property string $phone1
 * @property string $phone2
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
            [['customerId', 'address', 'fullName', 'phone1'], 'required'],
            [['customerId', 'isPrimary'], 'integer'],
            [['countryCode'], 'string', 'max' => 3],
            [['city'], 'string', 'max' => 100],
            [['zip'], 'string', 'max' => 10],
            [['address', 'fullName'], 'string', 'max' => 255],
            [['phone1', 'phone2'], 'string', 'max' => 15],
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
            'fullName' => 'Имя Фамилия',
            'phone1' => 'Моб. телефон',
            'phone2' => 'Доп. телефон',
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
