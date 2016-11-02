<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "productmarker".
 *
 * @property string $id
 * @property string $productId
 * @property integer $isActive
 * @property integer $isPreOrder
 * @property integer $isSpecialOffer
 * @property integer $isNew
 * @property integer $isSale
 * @property integer $isAdult
 *
 * @property Product $product
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
//            [['productId'], 'required'],
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
