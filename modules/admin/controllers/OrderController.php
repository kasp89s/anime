<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Order;
use app\modules\admin\models\search\OrderSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends AdminController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionList()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render(Yii::$app->controller->action->id, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionChange($id)
    {
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => 'Редактировать заказ',
            'url' => ['/'. Yii::$app->controller->module->id .'/'. Yii::$app->controller->id .'/'. Yii::$app->controller->action->id]
        ];

        $model = Order::findOne($id);
        if (empty($model))
            throw new \yii\web\NotFoundHttpException();

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
                    $productSpecificationRelation = new ProductSpecificationRelation();
                    $productSpecificationRelation->productId = $model->id;
                    $productSpecificationRelation->productSpecificationId = $specificationId;
                    $productSpecificationRelation->value = $specificationData['value'];
                    $productSpecificationRelation->isSearch = !empty($specificationData['isSearch']) ? 1 : 0;
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

        return $this->render(Yii::$app->controller->action->id, [
                'model' => $model,
            ]);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
