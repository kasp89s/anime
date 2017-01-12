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
use app\models\Specification;
use Yii;
use yii\data\Pagination;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use app\modules\admin\models\search\ProductsSearch;
use yii\web\NotFoundHttpException;

/**
 * ProductController Контроллер управления продуктами.
 *
 * @package app\modules\admin\controllers
 */
class ProductController extends AdminController {

    /**
     * Список записей.
     *
     * @return string
     */
    public function actionList()
    {
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render(Yii::$app->controller->action->id, [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
    }

    /**
     * Склонировать запись.
     *
     * @param $id
     *
     * @return \yii\web\Response
     *
     * @throws NotFoundHttpException
     */
    public function actionClone($id)
    {
        $sourceProduct = Product::findOne($id);

        if (empty($sourceProduct))
            throw new \yii\web\NotFoundHttpException('Страница не найдена.');

        $model = new Product();
        $incomingPrice = new IncomingPrice();
        $relatedProduct = new RelatedProduct();
        $productMarker = new ProductMarker();

        $model->attributes = $sourceProduct->attributes;
        $model->sku = uniqid();
        $model->save();

        $path = Yii::getAlias('@webroot') . '/uploads/product/' . $model->id;
        if (!is_dir($path)) {
            BaseFileHelper::createDirectory($path);
        }

        copy(Yii::getAlias('@webroot') . '/uploads/product/' . $sourceProduct->id . '/' . $sourceProduct->imageFileName , $path . '/' . $model->imageFileName);

        if (!empty($sourceProduct->images)) {
            foreach ($sourceProduct->images as $image) {
                $productImage = new ProductImage();
                $productImage->productId = $model->id;
                $productImage->imageFileName = $image->imageFileName;
                $productImage->save();
                copy(Yii::getAlias('@webroot') . '/uploads/product/' . $sourceProduct->id . '/' . $image->imageFileName , $path . '/' . $productImage->imageFileName);
            }
        }

        if (!empty($sourceProduct->categoryRelation)) {
            foreach ($sourceProduct->categoryRelation as $relation) {
                $productCategoryRelation = new ProductCategoryRelation();
                $productCategoryRelation->productId = $model->id;
                $productCategoryRelation->productCategoryId = $relation->productCategoryId;
                $productCategoryRelation->save();
            }
        }

        if (!empty($sourceProduct->specificationRelations)) {
            foreach ($sourceProduct->specificationRelations as $relation) {
                $productSpecificationRelation = new ProductSpecificationRelation();
                $productSpecificationRelation->productId = $model->id;
                $productSpecificationRelation->productSpecificationId = $relation->productSpecificationId;
                $productSpecificationRelation->value = $relation->value;
                $productSpecificationRelation->isSearch = $relation->isSearch;
                $productSpecificationRelation->save();
            }
        }

        if (!empty($sourceProduct->productAttributes)) {
            foreach ($sourceProduct->productAttributes as $relation) {
                $productAttribute = new Attribute();
                $productAttribute->productId = $model->id;
                $productAttribute->productOptionId = $relation->productOptionId;
                $productAttribute->productOptionValueId = $relation->productOptionValueId;
                $productAttribute->save();
            }
        }

        $incomingPrice->attributes = $sourceProduct->incomingPrice->attributes;
        $incomingPrice->productId = $model->id;
        $incomingPrice->save();

//        $relatedProduct->attributes = $sourceProduct->attributes;
//        $relatedProduct->idProduct = $model->id;
//        $relatedProduct->save();

        $productMarker->attributes = $sourceProduct->marker->attributes;
        $productMarker->productId = $model->id;
        $productMarker->save();

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Создание записи.
     *
     * @return string
     */
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

        if (
            $model->load($this->_post) && $model->validate() &&
            $incomingPrice->load($this->_post) && $incomingPrice->validate() &&
            $relatedProduct->load($this->_post) && $relatedProduct->validate() &&
            $productMarker->load($this->_post) && $productMarker->validate()
        ) {
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

            if (!empty($this->_post['specifications'])) {
                foreach ($this->_post['specifications'] as $specificationId => $specificationData) {
                    $specification = Specification::findOne($specificationId);
                    $productSpecificationRelation = new ProductSpecificationRelation();
                    $productSpecificationRelation->productId = $model->id;
                    $productSpecificationRelation->productSpecificationId = $specificationId;
                    $productSpecificationRelation->value = $specificationData['value'];
                    $productSpecificationRelation->isSearch = !empty($specification->isSearch) ? 1 : 0;
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

            $incomingPrice->productId = $model->id;
            $incomingPrice->save();

            if (!empty($this->_post['RelatedProduct']['relatedProductId'])) {
                $relatedProduct->idProduct = $model->id;
                $relatedProduct->relatedProductId = json_encode($this->_post['RelatedProduct']['relatedProductId']);
                $relatedProduct->save();
            }

            $productMarker->productId = $model->id;
            $productMarker->save();

            Yii::$app->response->redirect(array("admin/" . Yii::$app->controller->id . "/list"));
        }

        return $this->render(Yii::$app->controller->action->id, [
                'model' => $model,
                'incomingPrice' => $incomingPrice,
                'relatedProduct' => $relatedProduct,
                'productMarker' => $productMarker,
            ]);
    }

    /**
     * Редактировние записи.
     *
     * @param int $id
     *
     * @return string
     *
     * @throws NotFoundHttpException
     */
    public function actionChange($id)
    {
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => 'Редактировать товар',
            'url' => ['/'. Yii::$app->controller->module->id .'/'. Yii::$app->controller->id .'/'. Yii::$app->controller->action->id]
        ];

        $model = Product::findOne($id);
        if (empty($model))
            throw new \yii\web\NotFoundHttpException();

        $model->categoriesMultiple = $model->categories;
        $model->specificationsMultiple = $model->specifications;
        foreach ($model->productAttributes as $attribute) {
            $model->attributesMultiple[] = $attribute->productOptionId . ';' . $attribute->productOptionValueId;
        }

        if ($model->load($this->_post) && $model->validate()) {
            $model->updateTime = date('Y-m-d H:i:s', time());

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
                $model->imageFileName = !empty($photo) ? $photo : null ;
            }

            $uploadImages = UploadedFile::getInstances($model, 'imagesMultiple');
            if (!empty($uploadImages)) {
                Yii::$app->session->setFlash('tab', 5);
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
                Yii::$app->session->setFlash('tab', 3);
                ProductCategoryRelation::deleteAll('productId = :id', [':id' => $model->id]);
                foreach ($this->_post['Product']['categoriesMultiple'] as $categoryId) {
                    $productCategoryRelation = new ProductCategoryRelation();
                    $productCategoryRelation->productId = $model->id;
                    $productCategoryRelation->productCategoryId = $categoryId;
                    $productCategoryRelation->save();
                }
            }

            if (!empty($this->_post['specifications'])) {
                ProductSpecificationRelation::deleteAll('productId = :id', [':id' => $model->id]);
                foreach ($this->_post['specifications'] as $specificationId => $specificationData) {
                    $specification = Specification::findOne($specificationId);
                    $productSpecificationRelation = new ProductSpecificationRelation();
                    $productSpecificationRelation->productId = $model->id;
                    $productSpecificationRelation->productSpecificationId = $specificationId;
                    $productSpecificationRelation->value = $specificationData['value'];
                    $productSpecificationRelation->isSearch = !empty($specification->isSearch) ? 1 : 0;
                    $productSpecificationRelation->save();
                }
            }

            if (!empty($this->_post['Product']['attributesMultiple'])) {
                Attribute::deleteAll('productId = :id', [':id' => $model->id]);
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
            Yii::$app->session->setFlash('save', 'Изменения успешно сохранены.');
        }

        if ($model->incomingPrice->load($this->_post) && $model->incomingPrice->validate()) {
            $model->incomingPrice->save();
            Yii::$app->session->setFlash('save', 'Изменения успешно сохранены.');
            Yii::$app->session->setFlash('tab', 2);
        }

        if (!empty($this->_post['RelatedProduct']['relatedProductId'])) {
            $model->relatedProduct->load($this->_post);
            $model->relatedProduct->relatedProductId = json_encode($this->_post['RelatedProduct']['relatedProductId']);
            $model->relatedProduct->save();
            Yii::$app->session->setFlash('save', 'Изменения успешно сохранены.');
            Yii::$app->session->setFlash('tab', 4);
        }

        if ($model->marker->load($this->_post) && $model->marker->validate()) {
            $model->marker->save();
            Yii::$app->session->setFlash('save', 'Изменения успешно сохранены.');
            Yii::$app->session->setFlash('tab', 4);
        }

        if (!empty($this->_post['ProductImage'])) {
            foreach ($this->_post['ProductImage'] as $imageId => $rank) {
                $image = ProductImage::findOne($imageId);
                $image->rank = $rank;
                $image->save();
            }
            Yii::$app->session->setFlash('save', 'Изменения успешно сохранены.');
            Yii::$app->session->setFlash('tab', 5);
        }
        return $this->render(Yii::$app->controller->action->id, [
            'model' => $model,
        ]);
    }

    /**
     * Удаление картинки.
     *
     * @param $id
     *
     * @return \yii\web\Response
     */
    public function actionImageRemove($id)
    {
        ProductImage::deleteAll('id = :id', [':id' => $id]);

        Yii::$app->session->setFlash('save', 'Изменения успешно сохранены.');
        Yii::$app->session->setFlash('tab', 5);

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Возвращает атрибуты.
     */
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

            if (!empty($category->parent) && !empty($category->parent->options)) {
                foreach ($category->parent->options as $option) {
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

            if (!empty($category->parent) && !empty($category->parent->specifications)) {
                foreach ($category->parent->specifications as $specification) {
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

    /**
     * Перегрузка активации.
     *
     * @param int $id
     *
     * @return \yii\web\Response
     */
    public function actionActive($id)
    {
        $marker = ProductMarker::find()->where(['productId' => $id])->one();

        if (!empty($marker) && isset($marker->isActive)) {
            $marker->isActive = empty($marker->isActive) ? 1 : 0;
            $marker->save();
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param string $id
     *
     * @return Product the loaded model
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
