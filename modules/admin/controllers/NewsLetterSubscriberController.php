<?php
namespace app\modules\admin\controllers;

use Yii;
use app\models\NewsLetterSubscriber;
use app\modules\admin\models\search\NewsLetterSubscriberSearch;
use yii\web\NotFoundHttpException;
class NewsLetterSubscriberController extends AdminController {

    public function actionList()
    {
        $searchModel = new NewsLetterSubscriberSearch();
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
            'label' => 'Создать',
            'url' => ['/'. Yii::$app->controller->module->id .'/'. Yii::$app->controller->id .'/'. Yii::$app->controller->action->id]
        ];

        return parent::actionCreate();
    }

    public function actionChange($id)
    {
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => 'Редактировать',
            'url' => ['/'. Yii::$app->controller->module->id .'/'. Yii::$app->controller->id .'/'. Yii::$app->controller->action->id]
        ];

        return parent::actionChange($id);
    }

    /**
     * Finds the NewsLetterSubscriber model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return NewsLetterSubscriber the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = NewsLetterSubscriber::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
