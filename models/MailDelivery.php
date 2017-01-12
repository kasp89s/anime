<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "maildelivery".
 *
 * @property string $id     Идентификатор.
 * @property string $title  Название сообщения.
 * @property string $body   Тело сообщения.
 * @property string $status Статус.
 *
 * @property MailQueue[] $mailqueues Модель очереди писем.
 *
 * @package app\models
 */
class MailDelivery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'maildelivery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['body', 'status'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Тайтл',
            'body' => 'Тело',
            'status' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailQueues()
    {
        return $this->hasMany(MailQueue::className(), ['sourceId' => 'id']);
    }

    public function getMailQueuesCount()
    {
        return $this->hasMany(MailQueue::className(), ['sourceId' => 'id'])->count();
    }
}
