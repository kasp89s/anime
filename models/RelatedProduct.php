<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "relatedproduct".
 *
 * @property string  $idProduct        Ссылка на продукт.
 * @property integer $relatedProductId Связаные продукты.
 * @property integer $isAutoRelation   Авто связь.
 *
 * @property Product $idProduct0 Модель продукта.
 *
 * @package app\models
 */
class RelatedProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'relatedproduct';
    }

    public static function primaryKey()
    {
        return ['idProduct'];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['relatedProductId'], 'safe'],
            [['idProduct', 'isAutoRelation'], 'integer'],
            [['idProduct'], 'unique', 'targetAttribute' => ['idProduct'], 'message' => 'The combination of Id Product and Related Product ID has already been taken.'],
            [['idProduct'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['idProduct' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idProduct' => 'Id Product',
            'relatedProductId' => 'Связаные товары',
            'isAutoRelation' => 'Авто связь',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'idProduct']);
    }
}
