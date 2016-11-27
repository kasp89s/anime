<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "productspecification".
 *
 * @property string $id
 * @property string $name
 *
 * @property Category[] $categories
 * @property Product[] $products
 */
class Specification extends \yii\db\ActiveRecord
{
    protected $productsCount = null;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'productspecification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
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
            'name' => 'Название',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'productCategoryId'])->viaTable('productcategoryproductspecificationrelation', ['productSpecificationId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'productId'])->viaTable('productproductspecificationrelation', ['productSpecificationId' => 'id']);
    }

    public function findProducts($categories)
    {
        $categories = implode(',', $categories);
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
        SELECT COUNT(`productproductspecificationrelation`.`productId`) as `count`, `value`, `productproductspecificationrelation`.`id`
            FROM `productproductspecificationrelation`
            LEFT JOIN `product` ON `productproductspecificationrelation`.`productId` = `product`.`id`
            LEFT JOIN `productcategoryrelation` ON `product`.`id` = `productcategoryrelation`.`productId`
            LEFT JOIN `productcategory` ON `productcategoryrelation`.`productCategoryId` = `productcategory`.`id`
                WHERE (`productcategory`.`id` IN ({$categories})) AND (`productSpecificationId`= :productSpecificationId) AND (`isSearch`=1)
              GROUP BY `value` ORDER BY `count` DESC",
            [
                ':productSpecificationId' => $this->id,
            ]);

        $this->productsCount = $command->queryAll();
    }

    public function getValuesByProductsCount()
    {
        return $this->productsCount;
    }
}
