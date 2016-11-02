<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "relatedproduct".
 *
 * @property string $idProduct
 * @property integer $relatedProductId
 * @property integer $isAutoRelation
 *
 * @property Product $idProduct0
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
//            [['idProduct'], 'required'],
            [['idProduct', 'relatedProductId', 'isAutoRelation'], 'integer'],
            [['idProduct', 'relatedProductId'], 'unique', 'targetAttribute' => ['idProduct', 'relatedProductId'], 'message' => 'The combination of Id Product and Related Product ID has already been taken.'],
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
