<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "banner".
 *
 * @property integer $id            Идентификатор.
 * @property string  $name          Имя банера.
 * @property string  $imageFileName Имя картинки.
 * @property string  $startTime     Время начала показа.
 * @property string  $endTime       Время окончания показа.
 * @property integer $isActive      Активность.
 * @property string  $createTime    Время создания.
 * @property string  $updateTime    Время обновления.
 * @property string  $createUserId  Ссылка на администратора который создал запись.
 * @property string  $updateUserId  Ссылка на администратора который обновил запись.
 *
 * @package app\models
 */
class Banner extends \yii\db\ActiveRecord
{
    public $image;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'createUserId'], 'required'],
            [['content', 'imageFileName'], 'string'],
            [['id', 'isActive', 'createUserId', 'updateUserId'], 'integer'],
            [['image'], 'file', 'extensions' => 'gif, jpg, png'],
            [['startTime', 'createTime', 'endTime', 'updateTime'], 'safe'],
            [['name', 'imageFileName'], 'string', 'max' => 255],
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
            'content' => 'Контент',
            'image' => 'Картинка',
//            'imageFileName' => 'Image File Name',
            'startTime' => 'Время начала',
            'endTime' => 'Время завершения',
            'isActive' => 'Активен',
            'createTime' => 'Создан',
            'updateTime' => 'Обновлен',
            'createUserId' => 'Создал',
            'updateUserId' => 'Обновил',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdateUser()
    {
        return $this->hasOne(User::className(), ['id' => 'updateUserId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreateUser()
    {
        return $this->hasOne(User::className(), ['id' => 'createUserId']);
    }
}
