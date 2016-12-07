<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * QuickOrderForm is the model behind the login form.
 */
class WaitForm extends Model
{
    public $email;

    public $productId;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['email', 'productId'], 'required'],
            ['email', 'email', 'message' => 'Поле должно содержать корректный E-mail'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => 'E-mail',
        ];
    }
}
