<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "newsletter".
 *
 * @property string $id          Идентификатор.
 * @property string $title       Титулка.
 * @property string $description Описание.
 *
 * @package app\models
 */
class NewsLetter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'newsletter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'description' => 'Описание',
        ];
    }
}
