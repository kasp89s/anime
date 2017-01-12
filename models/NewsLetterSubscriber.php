<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "newslettersubscriber".
 *
 * @property string  $id         Идентификатор.
 * @property string  $customerId Ссылка на клиента.
 * @property string  $email      Почта.
 * @property integer $isActive   Флаг активности.
 * @property string  $code       Код.
 * @property string  $createTime Время создания.
 *
 * @property Customer $customer Модель клиента.
 *
 * @package app\models
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
            'customerId' => 'Клиент',
            'email' => 'E-mail',
            'isActive' => 'Активность',
            'code' => 'Код',
            'createTime' => 'Время создания',
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
