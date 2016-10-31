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
use yii\data\Pagination;

class CustomerController extends AdminController {

    public function actionList()
    {
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => 'Список клиентов',
            'url' => ['/admin/customer/list']
        ];

        $query = Customer::find();
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
            Yii::$app->response->redirect(array("admin/" . Yii::$app->controller->id . "/list"));
        }

        return $this->render(Yii::$app->controller->action->id, [
                'model' => $model,
            ]);
    }
}
