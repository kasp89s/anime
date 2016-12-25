<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mailqueue".
 *
 * @property string $id
 * @property string $sourceId
 * @property string $customerId
 * @property string $status
 *
 * @property Customer $customer
 * @property MailDelivery $source
 */
class MailQueue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mailqueue';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sourceId', 'customerId'], 'required'],
            [['sourceId', 'customerId'], 'integer'],
            [['status'], 'string'],
            [['customerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customerId' => 'id']],
            [['sourceId'], 'exist', 'skipOnError' => true, 'targetClass' => MailDelivery::className(), 'targetAttribute' => ['sourceId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sourceId' => 'Очередь',
            'customerId' => 'Пользователь',
            'status' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customerId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSource()
    {
        return $this->hasOne(MailDelivery::className(), ['id' => 'sourceId']);
    }
}
