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
 * @property string $isActive
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
            [['productId', 'userName', 'userEmail', 'message'], 'required'],
            [['productId','isActive', 'rating'], 'integer'],
            [['message'], 'string'],
            [['date'], 'safe'],
            ['userEmail', 'email', 'message' => 'Поле должно содержать корректный E-mail'],
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
            'userName' => 'Ваше имя',
            'userEmail' => 'E-mail',
            'rating' => 'Рейтинг',
            'message' => 'Текст отзыва',
            'date' => 'Время',
            'isActive' => 'Активность',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'productId']);
    }

    /**
     * Возвращает форматированую дату.
     *
     * @param string $date
     *
     * @return bool|string
     */
    public static function getDate($date)
    {
        $time = strtotime($date);
        $monthData = [
            '01' => 'Января',
            '02' => 'Февраля',
            '03' => 'Марта',
            '04' => 'Апреля',
            '05' => 'Мая',
            '06' => 'Июня',
            '07' => 'Июля',
            '08' => 'Августа',
            '09' => 'Сентября',
            '10' => 'Октября',
            '11' => 'Ноября',
            '12' => 'Декабря'
        ];

        $month = $monthData[date('m', $time)];

        return date("d {$month} Y в H:i", $time);
    }
}
