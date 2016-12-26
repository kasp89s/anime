<?php
namespace app\modules\admin\controllers;

use app\models\Category;
use app\models\CategoryOptionRelation;
use app\models\CategorySpecificationRelation;
use Yii;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;

/**
 * CategoryController Контроллер управления категориями товаров.
 *
 * @package app\modules\admin\controllers
 */
class CategoryController extends AdminController {

    /**
     * Список записей.
     *
     * @return string
     */
    public function actionList()
    {
        $records = Category::find()->where(['level' => 0])->orderBy('sortOrder desc')->all();

        return $this->render('list',
            [
                'records' => $records,
            ]
        );
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
            'label' => 'Создать категорию',
            'url' => [Yii::$app->controller->module->id .'/'. Yii::$app->controller->id .'/'. Yii::$app->controller->action->id]
        ];

        $model = new Category();
        $model->createTime = date('Y-m-d H:i:s', time());
        if ($model->load($this->_post) && $model->validate()) {
            $model->save();
            $path = Yii::getAlias('@webroot') . '/uploads/category/' . $model->id;
            if (!is_dir($path)) {
                BaseFileHelper::createDirectory($path);
            }

            $uploadPhotos = UploadedFile::getInstances($model, 'image');

            if (!empty($uploadPhotos)) {
                foreach ($uploadPhotos as $file) {
                    $photo = $file->baseName . '.' . $file->extension;
                    $file->saveAs($path . '/' . $file->baseName . '.' . $file->extension);
                }
            }

            $model->imageFileName = !empty($photo) ? $photo : null;
            $model->level = 0;
            $model->sortOrder = $this->getNextSortValue($model);
//            var_dump($model->sortOrder);exit;
            $model->save();
            if (!empty($model->optionsList)) {
                foreach ($model->optionsList as $optionId) {
                    $relation = new CategoryOptionRelation();
                    $relation->productCategoryId = $model->id;
                    $relation->productOptionId = $optionId;
                    $relation->save();
                }
            }
            if (!empty($model->specificationsList)) {
                foreach ($model->specificationsList as $specificationId) {
                    $relation = new CategorySpecificationRelation();
                    $relation->productCategoryId = $model->id;
                    $relation->productSpecificationId = $specificationId;
                    $relation->save();
                }
            }
            Yii::$app->response->redirect(array("admin/" . Yii::$app->controller->id . "/list"));
        }

        return $this->render(Yii::$app->controller->action->id, [
                'model' => $model,
            ]);
    }

    /**
     * Редактировние записи.
     *
     * @param int $id
     *
     * @return string
     *
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionChange($id)
    {
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => 'Редактировать категорию',
            'url' => [Yii::$app->controller->module->id .'/'. Yii::$app->controller->id .'/'. Yii::$app->controller->action->id]
        ];

        $model = Category::findOne($id);
        $model->optionsList = $model->options;
        $model->specificationsList = $model->specifications;
        if (empty($model))
            throw new \yii\web\NotFoundHttpException();

        if ($model->load($this->_post) && $model->validate()) {
            $path = Yii::getAlias('@webroot') . '/uploads/category/' . $model->id;
            if (!is_dir($path)) {
                BaseFileHelper::createDirectory($path);
            }

            $uploadPhotos = UploadedFile::getInstances($model, 'image');

            if (!empty($uploadPhotos)) {
                foreach ($uploadPhotos as $file) {
                    $photo = $file->baseName . '.' . $file->extension;
                    $file->saveAs($path . '/' . $file->baseName . '.' . $file->extension);
                }
                $model->imageFileName = !empty($photo) ? $photo : null ;
            }

            $model->updateTime = date('Y-m-d H:i:s', time());
            $model->save();

            CategoryOptionRelation::deleteAll('productCategoryId = :id', [':id' => $model->id]);
            CategorySpecificationRelation::deleteAll('productCategoryId = :id', [':id' => $model->id]);

            if (!empty($model->optionsList)) {
                foreach ($model->optionsList as $optionId) {
                    $relation = new CategoryOptionRelation();
                    $relation->productCategoryId = $model->id;
                    $relation->productOptionId = $optionId;
                    $relation->save();
                }
            }

            if (!empty($model->specificationsList)) {
                foreach ($model->specificationsList as $specificationId) {
                    $relation = new CategorySpecificationRelation();
                    $relation->productCategoryId = $model->id;
                    $relation->productSpecificationId = $specificationId;
                    $relation->save();
                }
            }

            Yii::$app->session->setFlash('save', 'Изменения успешно сохранены.');
        }

        return $this->render(Yii::$app->controller->action->id, [
                'model' => $model,
            ]);
    }

    /**
     * Создать подкатегорию.
     *
     * @param $id
     *
     * @return string
     *
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionCreateSub($id)
    {
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => 'Добавить подкатегорию категорию',
            'url' => [Yii::$app->controller->module->id . '/' . Yii::$app->controller->id . '/' . Yii::$app->controller->action->id]
        ];

        $parent = Category::findOne($id);
        if (empty($parent))
            throw new \yii\web\NotFoundHttpException();

        $model = new Category();
        $model->createTime = date('Y-m-d H:i:s', time());
        if ($model->load($this->_post) && $model->validate()) {
            $model->save();
            $path = Yii::getAlias('@webroot') . '/uploads/category/' . $model->id;
            if (!is_dir($path)) {
                BaseFileHelper::createDirectory($path);
            }

            $uploadPhotos = UploadedFile::getInstances($model, 'image');

            if (!empty($uploadPhotos)) {
                foreach ($uploadPhotos as $file) {
                    $photo = $file->baseName . '.' . $file->extension;
                    $file->saveAs($path . '/' . $file->baseName . '.' . $file->extension);
                }
            }

            $model->imageFileName = !empty($photo) ? $photo : null ;
            $model->level = $parent->level + 1;
            $model->sortOrder = $this->getNextSortValue($model);
            $model->save();
            if (!empty($model->optionsList)) {
                foreach ($model->optionsList as $optionId) {
                    $relation = new CategoryOptionRelation();
                    $relation->productCategoryId = $model->id;
                    $relation->productOptionId = $optionId;
                    $relation->save();
                }
            }
            if (!empty($model->specificationsList)) {
                foreach ($model->specificationsList as $specificationId) {
                    $relation = new CategorySpecificationRelation();
                    $relation->productCategoryId = $model->id;
                    $relation->productSpecificationId = $specificationId;
                    $relation->save();
                }
            }
            Yii::$app->response->redirect(array("admin/" . Yii::$app->controller->id . "/list"));
        }

        return $this->render(Yii::$app->controller->action->id, [
            'model' => $model,
            'parent' => $parent,
        ]);
    }

    /**
     * Возвращет порядок сортировки категорий.
     *
     * @param Category $model
     *
     * @return int|mixed
     */
    protected function getNextSortValue(Category $model)
    {
        $result = Category::find()->select('max(sortOrder) as orderValue')->where(['level' => $model->level])->asArray()->one();
        return isset($result['orderValue']) ? $result['orderValue'] + 1 : 0;
    }
}
