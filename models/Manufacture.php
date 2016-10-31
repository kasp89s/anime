<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "productmanufacture".
 *
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $image
 *
 * @property Product[] $products
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
