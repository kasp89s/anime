<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "productimage".
 *
 * @property string $id            Идентификатор.
 * @property string $productId     Ссылка на продукт.
 * @property string $imageFileName Имя картинки.
 * @property string $rank          Порядок сортировки.
 *
 * @property Product $product
 *
 * @package app\models
 */
class ProductImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'productimage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['productId', 'imageFileName'], 'required'],
            [['id', 'productId', 'rank'], 'integer'],
            [['imageFileName'], 'string', 'max' => 255],
            [['productId'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['productId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'productId' => 'Product ID',
            'imageFileName' => 'Image File Name',
            'rank' => 'Rank',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'productId']);
    }
}
