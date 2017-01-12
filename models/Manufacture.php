<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "productmanufacture".
 *
 * @property string $id          Идентификатор.
 * @property string $name        Название.
 * @property string $description Описание.
 * @property string $image       Картинка.
 *
 * @property Product[] $products Модель продукта.
 *
 * @package app\models
 */
class Manufacture extends \yii\db\ActiveRecord
{
    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'productmanufacture';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['file'], 'file', 'extensions' => 'gif, jpg, png'],
            [['name'], 'string', 'max' => 45],
            [['image'], 'string', 'max' => 255],
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
            'description' => 'Описание',
            'file' => 'Картинка',
            'image' => 'Картинка',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['productManufactureId' => 'id']);
    }
}
