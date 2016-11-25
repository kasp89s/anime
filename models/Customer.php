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
 * @property string $fullName
 * @property string $code
 * @property string $registrationIp
 * @property string $registrationTime
 * @property string $memo
 * @property string $authID
 * @property string $authMethod
 *
 * @property CustomerGroup $group
 * @property CustomerAddress[] $address
 * @property CustomerPhone[] $phones
 * @property WishList[] $wishes
 * @property Product[] $wishProducts
 */
class Customer extends \yii\db\ActiveRecord
{
    const DEFAULT_CUSTOMER_ID = 0;

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
            [['registrationTime', 'authID', 'authMethod'], 'safe'],
            [['memo'], 'string'],
            [['email', 'fullName'], 'string', 'max' => 255],
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
            'fullName' => 'Имя Фамилия',
            'code' => 'Code',
            'registrationIp' => 'Ip регистрации',
            'registrationTime' => 'Время',
            'authID' => 'authID',
            'authMethod' => 'authMethod',
            'memo' => 'Memo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhones()
    {
        return $this->hasMany(CustomerPhone::className(), ['customerId' => 'id']);
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
        return $this->hasMany(CustomerAddress::className(), ['customerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWishes()
    {
        return $this->hasMany(WishList::className(), ['customerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWishProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'productId'])->viaTable('wishlist', ['customerId' => 'id']);
    }

    public function getPhonesArray()
    {
        $result = [];
        foreach ($this->phones as $phone)
        {
            $result[$phone->phone] = $phone->phone;
        }

        return $result;
    }

    public function getAddressArray()
    {
        $result = [];
        foreach ($this->address as $address)
        {
            $result[$address->id] = $address->city . ', ' . $address->address . ', ' . $address->zip;
        }

        return $result;
    }

    public function getPurchaseAmount()
    {
        $finishedStatuses = OrderStatus::find()->select('statusCode')->where(['isFinished' => 1])->asArray()->one();

        $purchaseAmount = Order::find()
            ->select('SUM(amount) as sum, order.id')
            ->joinWith('total', false)
            ->where([
                    'order.customerId' => $this->id,
                    'order.orderStatus' => $finishedStatuses
                ])
            ->asArray()->one();
        return (int) $purchaseAmount['sum'];
    }
    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }

    public function getDiscountByOrderAmount($amount)
    {
        if ($this->group->isActive == 1) {
            return round($amount / 100 * $this->group->groupDiscount);
        }

        return 0;
    }

    /**
     * Finds user by email
     *
     * @param  string      $email
     * @return static|null
     */
    public static function findByUsername($email)
    {
        $user = self::find()->where(['email' => $email])->one();
        if (!empty($user))
            return $user;

        return null;
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
