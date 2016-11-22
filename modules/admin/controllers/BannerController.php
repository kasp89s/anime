<?php
/**
 * Контроллер управления банерами.
 *
 * @version 1.0
 */
namespace app\modules\admin\controllers;

use app\models\Banner;
use Yii;

use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use app\modules\admin\models\search\BannerSearch;
use yii\web\NotFoundHttpException;

class BannerController extends AdminController {

    public function actionList()
    {
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => 'Список слайдов',
            'url' => [Yii::$app->controller->module->id .'/'. Yii::$app->controller->id .'/'. Yii::$app->controller->action->id]
        ];

        $searchModel = new BannerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render(Yii::$app->controller->action->id, [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
    }

    public function actionCreate()
    {
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => 'Создать слайд',
            'url' => [Yii::$app->controller->module->id .'/'. Yii::$app->controller->id .'/'. Yii::$app->controller->action->id]
        ];

        $model = new Banner();
        $model->createTime = date('Y-m-d H:i:s', time());
        $model->createUserId = \Yii::$app->user->id;
        if ($model->load($this->_post) && $model->validate()) {
            $model->save();
            $path = Yii::getAlias('@webroot') . '/uploads/banners/' . $model->id;
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
            $model->imageFileName = $photo;
            $model->save();
            Yii::$app->response->redirect(array("admin/" . Yii::$app->controller->id . "/list"));
        }

        return $this->render(Yii::$app->controller->action->id, [
                'model' => $model,
            ]);
    }

    public function actionChange($id)
    {
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => 'Редактировать слайд',
            'url' => [Yii::$app->controller->module->id .'/'. Yii::$app->controller->id .'/'. Yii::$app->controller->action->id]
        ];

        $model = Banner::findOne($id);

        if (empty($model))
            throw new NotFoundHttpException();

        if ($model->load($this->_post) && $model->validate()) {
            $path = Yii::getAlias('@webroot') . '/uploads/banners/' . $model->id;
            if (!is_dir($path)) {
                BaseFileHelper::createDirectory($path);
            }

            $uploadPhotos = UploadedFile::getInstances($model, 'image');

            if (!empty($uploadPhotos)) {
                foreach ($uploadPhotos as $file) {
                    $photo = $file->baseName . '.' . $file->extension;
                    $file->saveAs($path . '/' . $file->baseName . '.' . $file->extension);
                }
                $model->imageFileName = $photo;
            }
            $model->updateUserId = \Yii::$app->user->id;
            $model->updateTime = date('Y-m-d H:i:s', time());
            $model->save();
            Yii::$app->session->setFlash('save', 'Изменения успешно сохранены.');
        }

        return $this->render(Yii::$app->controller->action->id, [
                'model' => $model,
            ]);
    }

    /**
     * Finds the Banner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Banner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Banner::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
