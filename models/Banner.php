<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "banner".
 *
 * @property integer $id
 * @property string $name
 * @property string $imageFileName
 * @property string $startTime
 * @property string $endTime
 * @property integer $isActive
 * @property string $createTime
 * @property string $updateTime
 * @property string $createUserId
 * @property string $updateUserId
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
