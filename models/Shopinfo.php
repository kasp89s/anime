<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shopinfo".
 *
 * @property string $id
 * @property string $title
 * @property string $description
 * @property string $imageFileName
 * @property string $phone1
 * @property string $phone2
 * @property string $phone3
 * @property string $phone4
 * @property string $email
 * @property string $countryCode
 * @property string $city
 * @property string $zip
 * @property string $address
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
