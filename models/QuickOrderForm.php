<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * QuickOrderForm is the model behind the login form.
 */
class QuickOrderForm extends Model
{
    public $name;

    public $phone;

    public $productId;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'phone', 'productId'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Ваше имя',
            'phone' => 'Телефон',
            'productId' => 'productId',
        ];
    }
}
