<?php
namespace app\models;
use Yii;
use yii\base\ErrorException;
use yii\base\Model;
/**
 * RegisterForm is the model behind the login form.
 */
class RegisterForm extends Customer
{
    /**
     * Email.
     *
     * @var
     */
    public $email;

    public $passwordConfirm;

    public $password;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['email', 'password', 'passwordConfirm'], 'required'],
            ['password', 'string', 'min' => 6, 'max' => 32, 'message' => 'Парольдолжен быть от 6 до 16 символов'],
            ['passwordConfirm', 'compare', 'compareAttribute'=>'password', 'message'=>"Пароли не совпадают" ],
            ['email', 'email', 'message' => 'Поле должно содержать корректный E-mail'],
            ['email', 'unique', 'message' => 'Пользователь с таким E-mail уже зарегистрирован в системе'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => 'E-mail',
            'password' => 'Пароль',
            'passwordConfirm' => 'Подтвердите пароль',
        ];
    }

    public function check()
    {
        if ($this->validate()) {
            $customer = Customer::find()->where(['email' => $this->email])->one();
            if (!empty($customer)) {
                $this->addError('email', 'Такой пользователь уже зарегистрирован');
                return false;
            }
        }
    }

    public function register()
    {
        if ($this->validate()) {
            $group = CustomerGroup::find()->where([
                'isDefault' => 1
            ])->one();

            if (empty($group))
                throw new ErrorException('Группа пользователей по умолчанию не назначена');

            $activationCode = uniqid();
            $customer = new Customer();
            $customer->email = $this->email;
            $customer->password = md5($this->password);
            $customer->customerGroupId = $group->id;
            $customer->code = $activationCode;
            $customer->registrationIp = $_SERVER['REMOTE_ADDR'];
            $customer->save();

            $customerAddress = new CustomerAddress();
            $customerAddress->customerId = $customer->id;
            $customerAddress->save(false);

            return $customer;
        }
        return false;
    }
}