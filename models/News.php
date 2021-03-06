<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property string $id
 * @property string $title
 * @property string $shortContent
 * @property string $content
 * @property string $formatedShortContent
 * @property string $formatedContent
 * @property integer $isActive
 * @property string $publishTime
 * @property string $createTime
 * @property string $updateTime
 * @property string $createUserId
 * @property string $updateUserId
 *
 * @property User $updateUser
 * @property User $createUser
 */
class News extends \yii\db\ActiveRecord
{
    public $image;

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
