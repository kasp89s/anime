<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Модель формы сообщить о наличие.
 *
 * @package app\models
 */
class WaitForm extends Model
{
    /**
     * Почта.
     *
     * @var
     */
    public $email;

    /**
     * Ссылка на продукт.
     *
     * @var
     */
    public $productId;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['email', 'productId'], 'required'],
            ['productId', 'validateProduct'],
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

    /**
     * Выполняет проверку подписан ли пользователь на указанный продукт.
     */
    public function validateProduct()
    {
        $model = WaitingList::find()
            ->where([
                    'productId' => $this->productId,
                    'email' => $this->email
                ])
            ->one();

        if (!empty($model)) {
            $this->addError('productId', 'Вы уже подписаны на указаный товар.');
        }
    }
}
