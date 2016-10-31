<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "infopage".
 *
 * @property string $id
 * @property string $code
 * @property string $title
 * @property string $content
 * @property string $createTime
 * @property string $updateTime
 * @property string $createUserId
 * @property string $updateUserId
 *
 * @property User $updateUser
 * @property User $createUser
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
