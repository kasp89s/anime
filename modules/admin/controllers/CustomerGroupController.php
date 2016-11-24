<?php
namespace app\modules\admin\controllers;

use app\models\CustomerGroup;
use Yii;

use app\modules\admin\models\search\CustomerGroupSearch;
use yii\web\NotFoundHttpException;

class CustomerGroupController extends AdminController {

    public function actionList()
    {
        $searchModel = new CustomerGroupSearch();
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
            'label' => 'Создать группу клиентов',
            'url' => ['/admin/customer-group/create']
        ];

        return parent::actionCreate();
    }

    public function actionChange($id)
    {
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => 'Редактировать группу клиентов',
            'url' => ['/admin/customer-group/change']
        ];

        return parent::actionChange($id);
    }

    /**
     * Finds the CustomerGroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return CustomerGroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CustomerGroup::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
