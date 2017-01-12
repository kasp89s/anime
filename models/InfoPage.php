<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "infopage".
 *
 * @property string  $id            Идентификатор.
 * @property string  $code          Код.
 * @property string  $title         Название.
 * @property string  $content       Контент.
 * @property string  $createTime    Время создания.
 * @property string  $updateTime    Время обновления.
 * @property string  $createUserId  Ссылка на администратора который создал запись.
 * @property string  $updateUserId  Ссылка на администратора который обновил запись.
 *
 * @property User $updateUser Модель админа.
 * @property User $createUser Модель админа.
 *
 * @package app\models
 */
class InfoPage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'infopage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'title', 'content', 'createUserId'], 'required'],
            [['content'], 'string'],
            [['updateTime','createTime'], 'safe'],
            [['createUserId', 'updateUserId'], 'integer'],
            [['code'], 'string', 'max' => 45],
            [['title'], 'string', 'max' => 255],
            [['code'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Чпу',
            'title' => 'Заголовок',
            'content' => 'Контент',
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
