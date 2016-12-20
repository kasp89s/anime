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
 *
 * @property Customer $customer
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
