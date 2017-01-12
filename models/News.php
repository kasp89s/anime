<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "news".
 *
 * @property string  $id                   Идентификатор.
 * @property string  $title                Титулка.
 * @property string  $shortContent         Короткий контент.
 * @property string  $content              Контент.
 * @property string  $formatedShortContent Форматированый короткий контент.
 * @property string  $formatedContent      Форматированый контент.
 * @property integer $isActive             Флаг активности.
 * @property string  $publishTime          Время публикации.
 * @property string  $createTime           Время создания.
 * @property string  $updateTime           Время обновления.
 * @property string  $createUserId         Ссылка на администратора который создал запись.
 * @property string  $updateUserId         Ссылка на администратора который обновил запись.
 *
 * @property User $updateUser Модель админа.
 * @property User $createUser Модель админа.
 *
 * @package app\models
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * Параметр для работы с картинкой.
     *
     * @var
     */
    public $image;

    /**
     * Продукты связаные с новостью.
     *
     * @var bool
     */
    public $_products = false;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'shortContent', 'content', 'createUserId'], 'required'],
            [['shortContent', 'content', 'formatedShortContent', 'formatedContent'], 'string'],
            [['isActive', 'createUserId', 'updateUserId'], 'integer'],
            [['publishTime', 'createTime', 'updateTime'], 'safe'],
            [['title', 'imageFileName'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'gif, jpg, png'],
            [['updateUserId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updateUserId' => 'id']],
            [['createUserId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['createUserId' => 'id']],
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
            'shortContent' => 'Короткий контент',
            'content' => 'Контент',
            'imageFileName' => 'Картинка',
            'image' => 'Картинка',
            'formatedShortContent' => 'Форматированый короткий контент',
            'formatedContent' => 'Форматированый контент',
            'publishTime' => 'Время публикации',
            'createTime' => 'Время создания',
            'updateTime' => 'Время обновления',
            'createUserId' => 'Создал',
            'updateUserId' => 'Обновил',
            'isActive' => 'Активность',
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

    /**
     * Возвращает продукты связаные с новостью.
     *
     * @return array|bool|\yii\db\ActiveRecord[]
     */
    public function getProducts()
    {
        if (!empty($this->_products))
            return $this->_products;

        $articles = [];
        preg_match_all("|{(.*)}|iU", $this->content, $parts);

        if (empty($parts[0]))
                return $articles;

        foreach ($parts[0] as $part) {
            $articles[] = substr(strip_tags($part),1,-1);
            $this->content = str_replace($part, '', $this->content);
        }

        $this->_products = Product::find()
            ->where([
                'sku' => $articles
            ])->all();


        return $this->_products;
    }
}
