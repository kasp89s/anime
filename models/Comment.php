<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property string $id
 * @property string $productId
 * @property string $userName
 * @property string $userEmail
 * @property integer $rating
 * @property string $message
 * @property string $date
 *
 * @property Product $product
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['productId'], 'required'],
            [['productId', 'rating'], 'integer'],
            [['message'], 'string'],
            [['date'], 'safe'],
            [['userName', 'userEmail'], 'string', 'max' => 255],
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
            'userName' => 'User Name',
            'userEmail' => 'User Email',
            'rating' => 'Rating',
            'message' => 'Message',
            'date' => 'Date',
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
