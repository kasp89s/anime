<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "productcategory".
 *
 * @property string $id
 * @property string $name
 * @property string $parentId
 * @property string $sortOrder
 * @property string $description
 * @property string $imageFileName
 * @property integer $isActive
 * @property string $createTime
 * @property string $updateTime
 * @property integer $left
 * @property integer $right
 * @property integer $level
 *
 * @property Category $parent
 * @property Category[] $categories
 * @property Option[] $options
 * @property Specification[] $specifications
 * @property Product[] $products
 */
class Category extends \yii\db\ActiveRecord
{
    public $image;

    public $optionsList;

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
            [['parentId', 'sortOrder', 'isActive', 'left', 'right', 'level'], 'integer'],
            [['description'], 'string'],
            [['createTime', 'updateTime'], 'safe'],
            [['optionsList', 'specificationsList'], 'safe'],
            [['name'], 'string', 'max' => 500],
            [['imageFileName'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'gif, jpg, png'],
//            [['parentId'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['parentId' => 'id']],
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
//            'imageFileName' => 'Image File Name',
            'isActive' => 'Активность',
            'createTime' => 'Создан',
            'updateTime' => 'Обновлен',
            'left' => 'Left',
            'right' => 'Right',
            'level' => 'Уровень',
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
