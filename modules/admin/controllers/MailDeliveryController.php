<?php

namespace app\modules\admin\controllers;

use app\models\Customer;
use app\models\MailQueue;
use Yii;
use app\models\MailDelivery;
use app\modules\admin\models\search\MailDeliverySearch;
use yii\web\NotFoundHttpException;

/**
 * MailDeliveryController implements the CRUD actions for MailDelivery model.
 */
class MailDeliveryController extends AdminController
{
    /**
     * Lists all MailDelivery models.
     * @return mixed
     */
    public function actionList()
    {
        $searchModel = new MailDeliverySearch();
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
            'label' => 'Создать рассылку',
            'url' => ['/'. Yii::$app->controller->module->id .'/'. Yii::$app->controller->id .'/'. Yii::$app->controller->action->id]
        ];

        $model = new MailDelivery();
        if ($model->load($this->_post) && $model->validate()) {
            $model->save();

            foreach (Customer::find()->where(['isActive' => 1])->asArray()->all() as $customer) {
                $queue = new MailQueue();
                $queue->customerId = $customer['id'];
                $queue->sourceId = $model->id;
                $queue->save();
            }

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
            'label' => 'Редактировать рассылку',
            'url' => ['/'. Yii::$app->controller->module->id .'/'. Yii::$app->controller->id .'/'. Yii::$app->controller->action->id]
        ];

        return parent::actionChange($id);
    }

    /**
     * Finds the MailDelivery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return MailDelivery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MailDelivery::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
