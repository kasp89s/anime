<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "product".
 *
 * @property string $id                   Идентификатор.
 * @property string $sku                  Артикул.
 * @property string $name                 Название.
 * @property string $description          Описание.
 * @property string $quantityInStock      Количество в наличие.
 * @property string $quantityOfSold       Количество проданых.
 * @property string $barcode1             Штрихкод.
 * @property string $barcode2             Штрихкод.
 * @property string $barcode3             Штрихкод.
 * @property string $availableTime        Время доступности.
 * @property string $createTime           Время создания.
 * @property string $updateTime           Время обновления.
 * @property string $price                Стоимость.
 * @property string $currencyCode         Валюта.
 * @property string $productDisountId     Ссылка на скидку.
 * @property string $productManufactureId Ссылка на производителя.
 * @property string $imageFileName        Имя картинки.
 *
 * @property BasketProduct[]                $basketProducts         Модель продукта в корзине.
 * @property Comment[]                      $comments               Модель отзыва.
 * @property Manufacture                    $manufacture            Модель производителя.
 * @property Discount                       $discount               Модель скидки.
 * @property Attribute[]                    $productAttributes      Модель атрибута продукта.
 * @property Specification[]                $specifications         Модель спецификации.
 * @property Category[]                     $categories             Модель категории.
 * @property ProductImage[]                 $images                 Модель картинки продукта.
 * @property ProductCategoryRelation[]      $categoryRelation       Модель связи с категорией.
 * @property IncomingPrice                  $incomingPrice          Модель входящей цены.
 * @property ProductMarker[]                $marker                 Модель маркера продукта.
 * @property ProductSpecificationRelation[] $specificationRelations Модель связи со спецификацией.
 *
 * @package app\models
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * количество по умолчанию.
     */
    const DEFAULT_QUANTITY = 1;

    /**
     * Параметр для работы с картинкой.
     *
     * @var
     */
    public $image;

    /**
     * Параметр для работы с несколькими картинками.
     *
     * @var
     */
    public $imagesMultiple;

    /**
     * Параметр мультивыбора категорий.
     *
     * @var
     */
    public $categoriesMultiple;

    /**
     * Параметр мультивыбора спецификаций.
     *
     * @var
     */
    public $specificationsMultiple;

    /**
     * Параметр мультивыбора атрибутов.
     *
     * @var
     */
    public $attributesMultiple;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sku', 'name', 'currencyCode', 'productManufactureId'], 'required'],
            [['description'], 'string'],
            [['quantityInStock', 'quantityOfSold', 'productDisountId', 'productManufactureId'], 'integer'],
            [['availableTime', 'createTime', 'updateTime', 'categoriesMultiple', 'specificationsMultiple', 'attributesMultiple'], 'safe'],
            [['price'], 'number'],
            [['image'], 'file', 'extensions' => 'gif, jpg, png'],
            [['imagesMultiple'], 'file', 'extensions' => 'gif, jpg, png', 'maxFiles' => 20],
            [['sku', 'imageFileName'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 500],
            [['barcode1', 'barcode2', 'barcode3'], 'string', 'max' => 45],
            [['currencyCode'], 'string', 'max' => 3],
            [['sku'], 'unique'],
            [['productManufactureId'], 'exist', 'skipOnError' => true, 'targetClass' => Manufacture::className(), 'targetAttribute' => ['productManufactureId' => 'id']],
            [['productDisountId'], 'exist', 'skipOnError' => true, 'targetClass' => Discount::className(), 'targetAttribute' => ['productDisountId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sku' => 'Код товара',
            'name' => 'Название',
            'description' => 'Описание',
            'image' => 'Основная картинка',
            'imagesMultiple' => 'Изображения товара',
            'quantityInStock' => 'В наличии',
            'quantityOfSold' => 'Продано',
            'barcode1' => 'Barcode1',
            'barcode2' => 'Barcode2',
            'barcode3' => 'Barcode3',
            'availableTime' => 'Доступное время',
            'createTime' => 'Создан',
            'updateTime' => 'Обновлен',
            'price' => 'Цена продажи',
            'currencyCode' => 'Валюта',
            'productDisountId' => 'Скидка',
            'productManufactureId' => 'Производитель',
            'imageFileName' => 'Картинка',
            'categoriesMultiple' => 'Категории',
            'specificationsMultiple' => 'Спецификации',
            'attributesMultiple' => 'Атрибуты',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBasketProducts()
    {
        return $this->hasMany(BasketProduct::className(), ['productId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManufacture()
    {
        return $this->hasOne(Manufacture::className(), ['id' => 'productManufactureId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscount()
    {
        return $this->hasOne(Discount::className(), ['id' => 'productDisountId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductAttributes()
    {
        return $this->hasMany(Attribute::className(), ['productId' => 'id']);
    }

    public function getFormattedAttributes()
    {
        $result = [];
        foreach ($this->productAttributes as $attribute) {
            if (empty($result[$attribute->productOptionId])) {
                $result[$attribute->productOptionId] = [
                    'name' => $attribute->option->name,
                    'values' => [
                        $attribute->productOptionValueId => [
                            'name' => $attribute->optionValue->name,
                            'price' => $attribute->optionValue->price
                        ]
                    ]
                ];
            } else {
                $result[$attribute->productOptionId]['values'][$attribute->productOptionValueId] = [
                    'name' => $attribute->optionValue->name,
                    'price' => $attribute->optionValue->price
                ];
            }
        }

        return $result;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryRelation()
    {
        return $this->hasMany(ProductCategoryRelation::className(), ['productId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'productCategoryId'])->viaTable('productcategoryrelation', ['productId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(ProductImage::className(), ['productId' => 'id'])->orderBy(['rank' => SORT_ASC]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIncomingPrice()
    {
        return $this->hasOne(IncomingPrice::className(), ['productId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRelatedProduct()
    {
        return $this->hasOne(RelatedProduct::className(), ['idProduct' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMarker()
    {
        return $this->hasOne(ProductMarker::className(), ['productId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecificationRelations()
    {
        return $this->hasMany(ProductSpecificationRelation::className(), ['productId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecifications()
    {
        return $this->hasMany(Specification::className(), ['id' => 'productSpecificationId'])->viaTable('productproductspecificationrelation', ['productId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['productId' => 'id']);
    }

    /**
     * Возвращает реальную стоимость продукта.
     *
     * @return float
     */
    public function getRealPrice()
    {
        if (!empty($this->discount) && (strtotime($this->discount->startTime) < time()) && (time() < strtotime($this->discount->endTime))){
            if ($this->discount->type == Discount::TYPE_VALUE) {
                $calculatedPrice = round($this->price - $this->discount->value);
                return $calculatedPrice;
            }

            if ($this->discount->type == Discount::TYPE_PERCENT) {
                $calculatedPrice = round($this->price - ($this->price / 100 * $this->discount->value));
                return $calculatedPrice;
            }
        }

        return round($this->price);
    }

    /**
     * Возвращает стоимость с учетом скидки группы клиента.
     *
     * @return float|mixed
     */
    public function getPriceWithCustomerDiscount()
    {
        if (\Yii::$app->session->get('user')) {
            $customer = \Yii::$app->session->get('user');
        }

        if (!empty($customer) && $customer->group->isActive == 1) {
            $calculatedPrice = round($this->realPrice - ($this->realPrice / 100 * $customer->group->groupDiscount));

            return $calculatedPrice;
        }

        return $this->realPrice;
    }

    /**
     * Возвращает общую оценку по отзывам.
     *
     * @return float|int
     */
    public function getCommentsRate()
    {
        if (empty($this->comments)) {
            return 0;
        }

        $totalRate = 0;
        foreach ($this->comments as $comment)
        {
            $totalRate+= $comment->rating;
        }

        return round($totalRate / count($this->comments));
    }
}
