<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property string $id
 * @property string $email
 * @property string $password
 * @property string $customerGroupId
 * @property integer $isActive
 * @property string $code
 * @property string $registrationIp
 * @property string $registrationTime
 * @property string $memo
 *
 * @property Customergroup $customerGroup
 * @property Customeraddress[] $customeraddresses
 */
class Customer extends \yii\db\ActiveRecord
{
    public $passwordConfirm;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'password', 'customerGroupId', 'registrationIp'], 'required'],
            [['customerGroupId', 'isActive'], 'integer'],
            [['registrationTime'], 'safe'],
            [['memo'], 'string'],
            [['email'], 'string', 'max' => 255],
            [['password', 'code'], 'string', 'max' => 32],
            [['registrationIp'], 'string', 'max' => 16],
            ['email', 'unique', 'message' => 'Пользователь с таким E-mail уже зарегистрирован в системе'],
            ['password', 'string', 'min' => 6, 'max' => 32, 'message' => 'Парольдолжен быть от 6 до 16 символов'],
            ['passwordConfirm', 'compare', 'compareAttribute'=>'password', 'message'=>"Пароли не совпадают" ],
            ['email', 'email', 'message' => 'Поле должно содержать корректный E-mail'],
            [['customerGroupId'], 'exist', 'skipOnError' => true, 'targetClass' => CustomerGroup::className(), 'targetAttribute' => ['customerGroupId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'E-mail',
            'password' => 'Пароль',
            'passwordConfirm' => 'Пароль еще раз',
            'customerGroupId' => 'Группа',
            'isActive' => 'Активность',
            'code' => 'Code',
            'registrationIp' => 'Ip регистрации',
            'registrationTime' => 'Время',
            'memo' => 'Memo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(CustomerGroup::className(), ['id' => 'customerGroupId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddress()
    {
        return $this->hasOne(CustomerAddress::className(), ['customerId' => 'id']);
    }


    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (!empty($_POST['Customer']['hashedPassword'])) {
                $this->password = $_POST['Customer']['hashedPassword'];
            }

            return true;
        }
        return false;
    }
}
