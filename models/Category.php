<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "productcategory".
 *
 * @property string $id            Идентификатор.
 * @property string $name          Название категории.
 * @property string $parentId      Ссылка на родителя.
 * @property string $sortOrder     Значение сортировки относительно элементов уровня.
 * @property string $description   Описание.
 * @property string $imageFileName Имя файла картинки.
 * @property integer $isActive     Флаг активности.
 * @property string $createTime    Время создания.
 * @property string $updateTime    Время обновления.
 * @property integer $left
 * @property integer $right
 * @property integer $level
 *
 * @property Category        $parent         Модель категории.
 * @property Category[]      $categories     Модель Категории.
 * @property Option[]        $options        Модель Опции.
 * @property Specification[] $specifications Модель Спецификации.
 * @property Product[]       $products       Модель Товара.
 *
 * @package app\models
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * Картинка.
     *
     * @var
     */
    public $image;

    /**
     * Форматированый список опций.
     *
     * @var
     */
    public $optionsList;

    /**
     * Форматированый список спецификаций.
     *
     * @var
     */
    public $specificationsList;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'productcategory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parentId', 'sortOrder', 'isActive', 'left', 'right', 'level', 'isInQuickLink'], 'integer'],
            [['description'], 'string'],
            [['createTime', 'updateTime'], 'safe'],
            [['optionsList', 'specificationsList'], 'safe'],
            [['name'], 'string', 'max' => 500],
            [['imageFileName'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'gif, jpg, png'],
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
            'parentId' => 'Parent ID',
            'sortOrder' => 'Sort Order',
            'description' => 'Описание',
            'image' => 'Картинка',
            'optionsList' => 'Атрибуты категории',
            'specificationsList' => 'Спецификации категории',
            'isActive' => 'Активность',
            'createTime' => 'Создан',
            'updateTime' => 'Обновлен',
            'left' => 'Left',
            'right' => 'Right',
            'level' => 'Уровень',
            'isInQuickLink' => 'В Быстрые Ссылки',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Category::className(), ['id' => 'parentId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['parentId' => 'id'])->orderBy(['sortOrder'=>SORT_DESC]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptions()
    {
        return $this->hasMany(Option::className(), ['id' => 'productOptionId'])->viaTable('productcategoryproductoptionrelation', ['productCategoryId' => 'id']);

    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecifications()
    {
        return $this->hasMany(Specification::className(), ['id' => 'productSpecificationId'])->viaTable('productcategoryproductspecificationrelation', ['productCategoryId' => 'id']);

    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'productId'])->viaTable('productcategoryrelation', ['productCategoryId' => 'id']);
    }

    /**
     * @return int
     */
    public function getProductsCount()
    {
        return $this->hasMany(Product::className(), ['id' => 'productId'])->viaTable('productcategoryrelation', ['productCategoryId' => 'id'])->count();
    }
}
