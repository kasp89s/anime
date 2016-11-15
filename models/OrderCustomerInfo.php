<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ordercustomerinfo".
 *
 * @property string $id
 * @property string $orderId
 * @property string $сountryCode
 * @property string $city
 * @property string $zip
 * @property string $address
 * @property string $fullName
 * @property string $phone1
 * @property string $phone2
 *
 * @property Order $order
 */
class OrderCustomerInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ordercustomerinfo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orderId', 'сountryCode', 'city', 'address', 'fullName', 'phone1'], 'required'],
            [['orderId'], 'integer'],
            [['сountryCode'], 'string', 'max' => 3],
            [['city', 'address', 'fullName'], 'string', 'max' => 255],
            [['zip'], 'string', 'max' => 10],
            [['phone1'], 'string', 'max' => 15],
            [['phone2'], 'string', 'max' => 45],
            [['orderId'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['orderId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'orderId' => 'Order ID',
            'сountryCode' => 'сountry Code',
            'city' => 'City',
            'zip' => 'Zip',
            'address' => 'Address',
            'fullName' => 'Full Name',
            'phone1' => 'Phone1',
            'phone2' => 'Phone2',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'orderId']);
    }
}
