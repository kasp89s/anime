<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "customer".
 *
 * @property string  $id               ID.
 * @property string  $email            E-mail.
 * @property string  $password         Пароль.
 * @property string  $customerGroupId  Связь с группой.
 * @property integer $isActive         Признак активности.
 * @property string  $fullName         Полное имя.
 * @property string  $code             Код активации.
 * @property string  $registrationIp   ИП адресс.
 * @property string  $registrationTime Время регистрации.
 * @property string  $memo             Заметки.
 * @property string  $authID           Идентификатор в соц. сетях.
 * @property string  $authMethod       Метод авторизации соц. сети.
 *
 * @property CustomerGroup     $group           Группа.
 * @property CustomerAddress[] $address         Адресс.
 * @property CustomerPhone[]   $phones          Телефоны.
 * @property WishList[]        $wishes          Желания.
 * @property WaitingList[]     $waitingProducts Лист ожидания (Уведомить о наличие).
 * @property Product[]         $wishProducts    Избранные продукты.
 *
 * @package app\models
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
    public function getWaitingProducts()
    {
        return $this->hasMany(WaitingList::className(), ['customerId' => 'id']);
    }

    /**
     * Список желаний с сортировкой.
     *
     * @param string $sortColumn Столбец.
     * @param int    $sortType   Тип сортировки.
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWishProducts($sortColumn = 'id', $sortType = SORT_DESC)
    {
        return $this->hasMany(Product::className(), ['id' => 'productId'])->viaTable('wishlist', ['customerId' => 'id'])
            ->orderBy([$sortColumn => $sortType]);
    }

    /**
     * Массив телефонов пользователя.
     *
     * @return array
     */
    public function getPhonesArray()
    {
        $result = [];
        foreach ($this->phones as $phone)
        {
            $result[$phone->phone] = $phone->phone;
        }

        return $result;
    }

    /**
     * Массив адресов пользователя.
     *
     * @return array
     */
    public function getAddressArray()
    {
        $result = [];
        foreach ($this->address as $address)
        {
            $result[$address->id] = $address->city . ', ' . $address->address . ', ' . $address->zip;
        }

        return $result;
    }

    /**
     * Массив адресов пользователя для урезаного метода доствки.
     *
     * @return array
     */
    public function getLoopAddressArray()
    {
        $result = [];
        foreach ($this->address as $address)
        {
            $result[$address->id] = $address->city;
        }

        return $result;
    }

    /**
     * Возвращает сумму покупок пользователя.
     *
     * @return int
     */
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
