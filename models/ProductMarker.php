<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "productmarker".
 *
 * @property string  $id             Идентификатор.
 * @property string  $productId      Ссылка на продукт.
 * @property integer $isActive       Активен.
 * @property integer $isPreOrder     Предзаказ.
 * @property integer $isSpecialOffer Специальное предложение.
 * @property integer $isNew          Новый продукт.
 * @property integer $isSale         Доступен к продаже.
 * @property integer $isAdult        Для взрослых.
 *
 * @property Product $product Модель продукта.
 *
 * @package app\models
 */
class ProductMarker extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'productmarker';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['productId', 'isActive', 'isPreOrder', 'isSpecialOffer', 'isNew', 'isSale', 'isAdult'], 'integer'],
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
            'isActive' => 'Активен',
            'isPreOrder' => 'Предзаказ',
            'isSpecialOffer' => 'Специальное предложение',
            'isNew' => 'Новый',
            'isSale' => 'Продаеться',
            'isAdult' => '18+',
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
