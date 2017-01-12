<?php
namespace app\modules\admin\controllers;

use app\models\ShippingMethod;
use app\models\ShippingPaymentMethodRelation;
use Yii;
use yii\data\Pagination;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use app\modules\admin\models\search\ShippingMethodSearch;
use yii\web\NotFoundHttpException;

/**
 * ShippingMethodController Контроллер управления методами доставки.
 *
 * @package app\modules\admin\controllers
 */
class ShippingMethodController extends AdminController {

    /**
     * Список записей.
     *
     * @return string
     */
    public function actionList()
    {
        $searchModel = new ShippingMethodSearch();
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
            'label' => 'Создать',
            'url' => ['/'. Yii::$app->controller->module->id .'/'. Yii::$app->controller->id .'/'. Yii::$app->controller->action->id]
        ];

        $model = new ShippingMethod();
        if ($model->load($this->_post) && $model->validate()) {
            $model->save();
            $path = Yii::getAlias('@webroot') . '/uploads/shippingMethod/' . $model->id;
            if (!is_dir($path)) {
                BaseFileHelper::createDirectory($path);
            }

            $uploadPhotos = UploadedFile::getInstances($model, 'file');

            if (!empty($uploadPhotos)) {
                foreach ($uploadPhotos as $file) {
                    $photo = $file->baseName . '.' . $file->extension;
                    $file->saveAs($path . '/' . $file->baseName . '.' . $file->extension);
                }
                $model->imageFileName = $photo;
            }

            if (!empty($this->_post['ShippingMethod']['payments'])) {
                foreach ($this->_post['ShippingMethod']['payments'] as $paymentId) {
                    $shippingPaymentRelation = new ShippingPaymentMethodRelation();
                    $shippingPaymentRelation->paymentMethodId = $paymentId;
                    $shippingPaymentRelation->shippingMethodId = $model->id;
                    $shippingPaymentRelation->save();
                }
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
            'label' => 'Редактировать',
            'url' => ['/'. Yii::$app->controller->module->id .'/'. Yii::$app->controller->id .'/'. Yii::$app->controller->action->id]
        ];

        $model = ShippingMethod::findOne($id);

        if (empty($model))
            throw new \yii\web\NotFoundHttpException();
        $model->payments = $model->paymentMethods;
        if ($model->load($this->_post) && $model->validate()) {
            $path = Yii::getAlias('@webroot') . '/uploads/shippingMethod/' . $model->id;
            if (!is_dir($path)) {
                BaseFileHelper::createDirectory($path);
            }

            $uploadPhotos = UploadedFile::getInstances($model, 'file');

            if (!empty($uploadPhotos)) {
                foreach ($uploadPhotos as $file) {
                    $photo = $file->baseName . '.' . $file->extension;
                    $file->saveAs($path . '/' . $file->baseName . '.' . $file->extension);
                }
                $model->imageFileName = $photo;
            }

            if (!empty($this->_post['ShippingMethod']['payments'])) {
                ShippingPaymentMethodRelation::deleteAll('shippingMethodId = :id', [':id' => $model->id]);
                foreach ($this->_post['ShippingMethod']['payments'] as $paymentId) {
                    $shippingPaymentRelation = new ShippingPaymentMethodRelation();
                    $shippingPaymentRelation->paymentMethodId = $paymentId;
                    $shippingPaymentRelation->shippingMethodId = $model->id;
                    $shippingPaymentRelation->save();
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
     * Finds the ShippingMethod model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param string $id
     *
     * @return ShippingMethod the loaded model
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ShippingMethod::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
