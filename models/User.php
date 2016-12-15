<?php
namespace app\models;

use yii\db\ActiveRecord;

/**
 * Модель пользователя.
 *
 * @property string $id
 * @property string $email
 * @property string $password
 * @property string $userGroupId
 * @property integer $isActive
 * @property string $description
 */

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    const DEFAULT_USER = 0;

    protected $authKey;

    public $passwordConfirm;

    /**
     * @return string название таблицы, сопоставленной с этим ActiveRecord-классом.
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'password', 'userGroupId'], 'required'],
            [['userGroupId', 'isActive'], 'integer'],
            [['description'], 'string'],
            ['email', 'unique', 'message' => 'Пользователь с таким E-mail уже зарегистрирован в системе'],
            ['password', 'string', 'min' => 6, 'max' => 32, 'message' => 'Парольдолжен быть от 6 до 16 символов'],
            ['passwordConfirm', 'compare', 'compareAttribute'=>'password', 'message'=>"Пароли не совпадают" ],
            ['email', 'email', 'message' => 'Поле должно содержать корректный E-mail'],
            [['email'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Почта',
            'password' => 'Пароль',
            'passwordConfirm' => 'Пароль еще раз',
            'userGroupId' => 'Группа пользователя',
            'isActive' => 'Активен',
            'description' => 'Описание',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'userGroupId']);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $user = self::findOne($id);
        return isset($user) ? $user : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by email
     *
     * @param  string      $email
     * @return static|null
     */
    public static function findByUsername($email)
    {
		$user = User::find()->where(['email' => $email])->one();
        if (!empty($user))
            return $user;

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
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

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (!empty($_POST['User']['hashedPassword'])) {
                $this->password = $_POST['User']['hashedPassword'];
            }

            return true;
        }
        return false;
    }
}
