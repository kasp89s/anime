<?php
namespace app\modules\admin\controllers;

use app\models\Option;
use app\models\OptionValue;
use Yii;
use yii\data\Pagination;
use app\modules\admin\models\search\OptionSearch;
use yii\web\NotFoundHttpException;
class OptionController extends AdminController {

    public function actionList()
    {
        $searchModel = new OptionSearch();
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
            'label' => 'Создать атрибут',
            'url' => ['/'. Yii::$app->controller->module->id .'/'. Yii::$app->controller->id .'/'. Yii::$app->controller->action->id]
        ];

        return parent::actionCreate();
    }

    public function actionChange($id)
    {
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => 'Редактировать атрибут',
            'url' => ['/'. Yii::$app->controller->module->id .'/'. Yii::$app->controller->id .'/'. Yii::$app->controller->action->id]
        ];

        return parent::actionChange($id);
    }

    public function actionOptionCreate($id)
    {
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => 'Добавить значение атрибута',
            'url' => ['/'. Yii::$app->controller->module->id .'/'. Yii::$app->controller->id .'/'. Yii::$app->controller->action->id]
        ];

        $option = Option::findOne($id);

        if (empty($option))
            throw new \yii\web\NotFoundHttpException();

        $model = new OptionValue();

        if ($model->load($this->_post) && $model->validate()) {
            $model->save();
            Yii::$app->response->redirect(array("admin/" . Yii::$app->controller->id . "/list"));
        }

        return $this->render(Yii::$app->controller->action->id, [
            'option' => $option,
            'model' => $model,
        ]);
    }

    public function actionOptionChange($id)
    {
        $model = OptionValue::findOne($id);
        if (empty($model))
            throw new \yii\web\NotFoundHttpException();

        if ($model->load($this->_post) && $model->validate()) {
            $model->save();
            Yii::$app->session->setFlash('save', 'Изменения успешно сохранены.');
        }

        return $this->render(Yii::$app->controller->action->id, [
            'model' => $model,
        ]);
    }

    public function actionOptionRemove($id)
    {
        $model = OptionValue::findOne($id);;
        if (!empty($model)) {
            $model->delete();
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the Option model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Option the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Option::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
