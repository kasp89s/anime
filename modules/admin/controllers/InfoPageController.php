<?php
namespace app\modules\admin\controllers;

use app\models\InfoPage;
use Yii;
use yii\data\Pagination;
use app\modules\admin\models\search\InfoPageSearch;
use yii\web\NotFoundHttpException;
class InfoPageController extends AdminController {

    public function actionList()
    {
        $searchModel = new InfoPageSearch();
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
            'label' => 'Создать страницу',
            'url' => ['/'. Yii::$app->controller->module->id .'/'. Yii::$app->controller->id .'/'. Yii::$app->controller->action->id]
        ];

        return parent::actionCreate();
    }

    public function actionChange($id)
    {
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => 'Редактировать страницу',
            'url' => ['/'. Yii::$app->controller->module->id .'/'. Yii::$app->controller->id .'/'. Yii::$app->controller->action->id]
        ];

        if (Yii::$app->request->isPost) {
            $this->_post['InfoPage']['updateTime'] = date('Y-m-d H:i:s', time());
            $this->_post['InfoPage']['updateUserId'] = \Yii::$app->user->id;
        }

        return parent::actionChange($id);
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
        if (($model = InfoPage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
