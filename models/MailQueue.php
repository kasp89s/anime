<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "mailqueue".
 *
 * @property string $id         Идентификатор.
 * @property string $sourceId   Ссылка на рассылку.
 * @property string $customerId Ссылка на клиента.
 * @property string $status     Статус.
 *
 * @property Customer     $customer Модель клиента.
 * @property MailDelivery $source   Модель рассылки.
 *
 * @package app\models
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
