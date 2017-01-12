<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Модель формы быстрого заказа.
 *
 * @package app\models
 */
class QuickOrderForm extends Model
{
    /**
     * Имя.
     *
     * @var
     */
    public $name;

    /**
     * Телефон.
     *
     * @var
     */
    public $phone;

    /**
     * Ссылка на продуктю
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
