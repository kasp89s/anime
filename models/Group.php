<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usergroup".
 *
 * @property string $id
 * @property string $name
 * @property string $actions
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usergroup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['actions'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'actions' => 'Действия',
            'availableActions' => 'Доступные действия',
        ];
    }

    public function getAvailableActions()
    {

        return explode(',', $this->actions);
    }

    public function getActionList()
    {
        return [
            'user' => 'Пользователи',
            'group' => 'Группы пользователей',
            'customer' => 'Клиенты',
            'customer-group' => 'Группы клиентов',
            'banner' => 'Банера',
            'info-page' => 'Статические страницы',
            'manufacture' => 'Производители',
            'discount' => 'Скидки',
            'coupon' => 'Купоны',
            'shipping-method' => 'Доставка',
            'payment-method' => 'Оплата',
            'news' => 'Новости',
            'news-letter-subscriber' => 'Подписчики',
            'product' => 'Товары',
            'category' => 'Категории',
            'specification' => 'Спецификации',
            'option' => 'Опции',
            'order' => 'Заказы',
            'comment' => 'Комментарии'
        ];
    }
}
