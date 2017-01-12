<?php
namespace app\modules\admin\controllers;

use app\models\News;
use Yii;
use yii\data\Pagination;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use app\modules\admin\models\search\NewsSearch;
use yii\web\NotFoundHttpException;

/**
 * NewsController Контроллер управления новостями.
 *
 * @package app\modules\admin\controllers
 */
class NewsController extends AdminController {

    /**
     * Список записей.
     *
     * @return string
     */
    public function actionList()
    {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render(Yii::$app->controller->action->id, [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
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
            'label' => 'Создать новость',
            'url' => ['/'. Yii::$app->controller->module->id .'/'. Yii::$app->controller->id .'/'. Yii::$app->controller->action->id]
        ];

        if (Yii::$app->request->isPost) {
            if ($this->_post['News']['isActive']) {
                $this->_post['News']['publishTime'] = date('Y-m-d H:i:s', time());
            }
        }
        $model = new News();
        if ($model->load($this->_post) && $model->validate()) {
            $model->save();
            $path = Yii::getAlias('@webroot') . '/uploads/news/' . $model->id;
            if (!is_dir($path)) {
                BaseFileHelper::createDirectory($path);
            }
            $uploadPhotos = UploadedFile::getInstances($model, 'image');

            if (!empty($uploadPhotos)) {
                foreach ($uploadPhotos as $file) {
                    $photo = $file->baseName . '.' . $file->extension;
                    $file->saveAs($path . '/' . $file->baseName . '.' . $file->extension);
                }
                $model->imageFileName = !empty($photo) ? $photo : null;
            }
            $model->save();

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
     * @throws NotFoundHttpException
     */
    public function actionChange($id)
    {
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => 'Редактировать новость',
            'url' => ['/'. Yii::$app->controller->module->id .'/'. Yii::$app->controller->id .'/'. Yii::$app->controller->action->id]
        ];

        if (Yii::$app->request->isPost) {
            if ($this->_post['News']['isActive']) {
                $this->_post['News']['publishTime'] = date('Y-m-d H:i:s', time());
            }

            $this->_post['News']['updateTime'] = date('Y-m-d H:i:s', time());
            $this->_post['News']['updateUserId'] = \Yii::$app->user->id;
        }

        $model = News::findOne($id);
        if (empty($model))
            throw new \yii\web\NotFoundHttpException();

        if (!empty($model) && $model->load($this->_post) && $model->validate()) {
            $path = Yii::getAlias('@webroot') . '/uploads/news/' . $model->id;
            if (!is_dir($path)) {
                BaseFileHelper::createDirectory($path);
            }
            $uploadPhotos = UploadedFile::getInstances($model, 'image');

            if (!empty($uploadPhotos)) {
                foreach ($uploadPhotos as $file) {
                    $photo = $file->baseName . '.' . $file->extension;
                    $file->saveAs($path . '/' . $file->baseName . '.' . $file->extension);
                }
                $model->imageFileName = !empty($photo) ? $photo : null;
            }
            $model->save();
            Yii::$app->session->setFlash('save', 'Изменения успешно сохранены.');
        }

        return $this->render(Yii::$app->controller->action->id, [
            'model' => $model,
        ]);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param string $id
     *
     * @return News the loaded model
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
