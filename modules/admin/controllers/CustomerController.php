<?php
/**
 * Контроллер управления клиентами.
 *
 * @version 1.0
 */
namespace app\modules\admin\controllers;

use app\models\Customer;
use app\models\CustomerAddress;
use app\models\CustomerPhone;
use Yii;
use yii\base\Model;
use app\modules\admin\models\search\CustomerSearch;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * CustomerController Контроллер управления клиентами.
 *
 * @package app\modules\admin\controllers
 */
class CustomerController extends AdminController {

    /**
     * Список записей.
     *
     * @return string
     */
    public function actionList()
    {
        $searchModel = new CustomerSearch();
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
            'label' => 'Создать клиента',
            'url' => ['/admin/customer/create']
        ];

        if (Yii::$app->request->isPost) {
            $_POST['Customer']['hashedPassword'] = md5($this->_post['Customer']['password']);
        }

        return parent::actionCreate();
    }

    /**
     * Редактировние записи.
     *
     * @param int $id
     *
     * @return string
     */
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

    /**
     * Редактировние адреса пользователя.
     *
     * @param $id
     *
     * @throws NotFoundHttpException
     */
    public function actionChangeAddress($id)
    {
        $customer = Customer::findOne($id);

        if (empty($customer))
            throw new \yii\web\NotFoundHttpException();

            if (Model::loadMultiple($customer->address, Yii::$app->request->post())) {
                foreach ($customer->address as $address) {
                    $address->save();
                }
                Yii::$app->session->setFlash('save', 'Изменения успешно сохранены.');
                Yii::$app->session->setFlash('tab', 2);

                Yii::$app->response->redirect(array("admin/" . Yii::$app->controller->id . "/change/" . $id));
            }

            if (Model::loadMultiple($customer->phones, Yii::$app->request->post())) {
                foreach ($customer->phones as $phone) {
                    $phone->save();
                }
                Yii::$app->session->setFlash('save', 'Изменения успешно сохранены.');
                Yii::$app->session->setFlash('tab', 3);

                Yii::$app->response->redirect(array("admin/" . Yii::$app->controller->id . "/change/" . $id));
            }
    }

    /**
     * Создание нового адреса.
     *
     * @return array
     */
    public function actionNewAddress()
    {
        $model = new CustomerAddress();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return array_merge(ActiveForm::validate($model));
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();

            Yii::$app->session->setFlash('save', 'Изменения успешно сохранены.');
            Yii::$app->session->setFlash('tab', 2);

            Yii::$app->response->redirect(array("admin/" . Yii::$app->controller->id . "/change/" . $model->customerId));
        }
    }

    /**
     * Создание нового телефона
     *
     * @return array
     */
    public function actionNewPhone()
    {
        $model = new CustomerPhone();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return array_merge(ActiveForm::validate($model));
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();

            Yii::$app->session->setFlash('save', 'Изменения успешно сохранены.');
            Yii::$app->session->setFlash('tab', 3);

            Yii::$app->response->redirect(array("admin/" . Yii::$app->controller->id . "/change/" . $model->customerId));
        }
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
