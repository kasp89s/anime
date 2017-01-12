<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "currencies".
 *
 * @property string $id   Идентификатор.
 * @property string $code Код.
 * @property string $name Название.
 *
 * @package app\models
 */
class Currencies extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'currencies';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code'], 'string', 'max' => 3],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Код',
            'name' => 'Название',
        ];
    }
}
