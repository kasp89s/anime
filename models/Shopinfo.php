<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "shopinfo".
 *
 * @property string $id            Идентификатор.
 * @property string $title         Название.
 * @property string $description   Описание.
 * @property string $imageFileName Имя картинки.
 * @property string $phone1        Телефон.
 * @property string $phone2        Телефон.
 * @property string $phone3        Телефон.
 * @property string $phone4        Телефон.
 * @property string $email         Почта.
 * @property string $countryCode   Код страны.
 * @property string $city          Город.
 * @property string $zip           Индекс.
 * @property string $address       Адресс.
 *
 * @package app\models
 */
class Shopinfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shopinfo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'phone1', 'email', 'countryCode', 'city', 'address'], 'required'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 500],
            [['imageFileName', 'email', 'city', 'address'], 'string', 'max' => 255],
            [['phone1', 'phone2', 'phone3', 'phone4'], 'string', 'max' => 15],
            [['countryCode'], 'string', 'max' => 3],
            [['zip'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'imageFileName' => 'Image File Name',
            'phone1' => 'Phone1',
            'phone2' => 'Phone2',
            'phone3' => 'Phone3',
            'phone4' => 'Phone4',
            'email' => 'Email',
            'countryCode' => 'Country Code',
            'city' => 'City',
            'zip' => 'Zip',
            'address' => 'Address',
        ];
    }
}
