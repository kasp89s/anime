<?php
/**
 * Контроллер управления клиентами.
 *
 * @version 1.0
 */
namespace app\modules\admin\controllers;

use app\models\Customer;
use app\models\CustomerAddress;
use Yii;

use app\modules\admin\models\search\CustomerSearch;
use yii\web\NotFoundHttpException;

class CustomerController extends AdminController {

    public function actionList()
    {
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => 'Список клиентов',
            'url' => ['/admin/customer/list']
        ];

        $searchModel = new CustomerSearch();
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
            'label' => 'Создать клиента',
            'url' => ['/admin/customer/create']
        ];

        if (Yii::$app->request->isPost) {
            $_POST['Customer']['hashedPassword'] = md5($this->_post['Customer']['password']);
        }

        return parent::actionCreate();
    }

    public function actionChange($id)
    {
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => 'Редактировать пользователя',
            'url' => ['/admin/customer/change']
        ];

        if (Yii::$app->request->isPost) {
            if (empty($this->_post['Customer']['password'])) {
                unset($this->_post['Customer']['password']);
            } else {
                $_POST['Customer']['hashedPassword'] = md5($this->_post['Customer']['password']);
            }

        }

        return parent::actionChange($id);
    }

    public function actionChangeAddress($id)
    {
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => 'Редактировать адрес пользователя',
            'url' => ['/admin/customer/change-address']
        ];

        $customer = Customer::findOne($id);

        if (empty($customer))
            throw new \yii\web\NotFoundHttpException();

        $model = CustomerAddress::find()->where(['customerId' => $customer->id])->one();

        if (empty($model)) {
            $model = new CustomerAddress();
            $model->customerId = $customer->id;
        }

        if ($model->load($this->_post) && $model->validate()) {
            $model->save();
            Yii::$app->session->setFlash('save', 'Изменения успешно сохранены.');
        }

        return $this->render(Yii::$app->controller->action->id, [
                'model' => $model,
            ]);
    }

    /**
     * Finds the Customer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Customer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Customer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
