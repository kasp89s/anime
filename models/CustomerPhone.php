<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customerphone".
 *
 * @property string $id
 * @property string $customerId
 * @property string $phone
 *
 * @property Customer $customer
 */
class CustomerPhone extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customerphone';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customerId'], 'required'],
            [['customerId'], 'integer'],
            [['phone'], 'string', 'max' => 15],
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
            'customerId' => 'Customer ID',
            'phone' => 'Телефон',
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
