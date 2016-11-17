<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "newslettersubscriber".
 *
 * @property string $id
 * @property string $customerId
 * @property string $email
 * @property integer $isActive
 * @property string $code
 * @property string $createTime
 */
class NewsLetterSubscriber extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'newslettersubscriber';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customerId', 'isActive'], 'integer'],
            [['email'], 'required'],
            ['email', 'email', 'message' => 'Поле должно содержать корректный E-mail'],
            [['createTime'], 'safe'],
            [['email'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 32],
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
            'email' => 'Email',
            'isActive' => 'Активность',
            'code' => 'Code',
            'createTime' => 'Время содания',
        ];
    }
}
