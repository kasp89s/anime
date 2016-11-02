<?php
namespace app\modules\admin\controllers;

use app\models\Attribute;
use app\models\Category;
use app\models\IncomingPrice;
use app\models\Product;
use app\models\ProductCategoryRelation;
use app\models\ProductMarker;
use app\models\ProductSpecificationRelation;
use app\models\RelatedProduct;
use app\models\ProductImage;
use Yii;
use yii\data\Pagination;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;


class ProductController extends AdminController {

    public function actionList()
    {
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => 'Список товаров',
            'url' => ['/'. Yii::$app->controller->module->id .'/'. Yii::$app->controller->id .'/'. Yii::$app->controller->action->id]
        ];

        $query = Product::find();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 30]);
        $pages->pageSizeParam = false;
        $records = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy('id desc')
            ->all();

        return $this->render('list',
            [
                'records' => $records,
                'pages' => $pages,
            ]
        );
    }

    public function actionCreate()
    {
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => 'Создать товар',
            'url' => ['/'. Yii::$app->controller->module->id .'/'. Yii::$app->controller->id .'/'. Yii::$app->controller->action->id]
        ];

        $model = new Product();
        $incomingPrice = new IncomingPrice();
        $relatedProduct = new RelatedProduct();
        $productMarker = new ProductMarker();

        if ($model->load($this->_post) && $model->validate()) {
            $model->save();
            $path = Yii::getAlias('@webroot') . '/uploads/product/' . $model->id;
            if (!is_dir($path)) {
                BaseFileHelper::createDirectory($path);
            }

            $uploadImage = UploadedFile::getInstances($model, 'image');
            if (!empty($uploadImage)) {
                foreach ($uploadImage as $file) {
                    $photo = $file->baseName . '.' . $file->extension;
                    $file->saveAs($path . '/' . $file->baseName . '.' . $file->extension);
                }
            }

            $model->imageFileName = $photo;

            $uploadImages = UploadedFile::getInstances($model, 'imagesMultiple');
            if (!empty($uploadImages)) {
                foreach ($uploadImages as $file) {
                    $photo = $file->baseName . '.' . $file->extension;
                    $file->saveAs($path . '/' . $file->baseName . '.' . $file->extension);
                    $productImage = new ProductImage();
                    $productImage->productId = $model->id;
                    $productImage->imageFileName = $photo;
                    $productImage->save();
                }
            }

            if (!empty($this->_post['Product']['categoriesMultiple'])) {
                foreach ($this->_post['Product']['categoriesMultiple'] as $categoryId) {
                    $productCategoryRelation = new ProductCategoryRelation();
                    $productCategoryRelation->productId = $model->id;
                    $productCategoryRelation->productCategoryId = $categoryId;
                    $productCategoryRelation->save();
                }
            }

            if (!empty($this->_post['Product']['specificationsMultiple'])) {
                foreach ($this->_post['Product']['specificationsMultiple'] as $specificationId) {
                    $productSpecificationRelation = new ProductSpecificationRelation();
                    $productSpecificationRelation->productId = $model->id;
                    $productSpecificationRelation->productSpecificationId = $specificationId;
                    $productSpecificationRelation->save();
                }
            }

            if (!empty($this->_post['Product']['attributesMultiple'])) {
                foreach ($this->_post['Product']['attributesMultiple'] as $attribute) {
                    $attribute = explode(';', $attribute);
                    $productAttribute = new Attribute();
                    $productAttribute->productId = $model->id;
                    $productAttribute->productOptionId = $attribute[0];
                    $productAttribute->productOptionValueId = $attribute[1];
                    $productAttribute->save();
                }
            }
            $model->save();

            Yii::$app->response->redirect(array("admin/" . Yii::$app->controller->id . "/list"));
//            $incomingPrice->productId = $model->id;
//            $model->load($this->_post)
        }

        return $this->render(Yii::$app->controller->action->id, [
                'model' => $model,
                'incomingPrice' => $incomingPrice,
                'relatedProduct' => $relatedProduct,
                'productMarker' => $productMarker,
            ]);
    }

    public function actionChange($id)
    {
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => 'Редактировать товар',
            'url' => ['/'. Yii::$app->controller->module->id .'/'. Yii::$app->controller->id .'/'. Yii::$app->controller->action->id]
        ];

        return parent::actionChange($id);
    }

    public function actionGetAttributes()
    {
        $this->layout = false;

        $categories = Category::find()
        ->where('id IN ('. implode(',', $this->_post['categories']) .')')->all();
        $attributes = [];
        $specifications = [];
        foreach ($categories as $category) {
            if (!empty($category->options)) {
                foreach ($category->options as $option) {
                    if (empty($option->values)) continue;
                        foreach ($option->values as $optionValue) {
                            $attributes[$option->id . ';' . $optionValue->id] = $option->name . ' - ' . $optionValue->name . ' - ' . $optionValue->price;
                        }
                }
            }

            if (!empty($category->specifications)) {
                foreach ($category->specifications as $specification) {
                    $specifications[$specification->id] = $specification->name;
                }
            }
        }

        echo \yii\helpers\BaseJson::encode([
                'attributes' => $attributes,
                'specifications' => $specifications,
            ]);
        Yii::$app->end();
    }
}
