<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "maildelivery".
 *
 * @property string $id
 * @property string $title
 * @property string $body
 * @property string $status
 *
 * @property MailQueue[] $mailqueues
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
