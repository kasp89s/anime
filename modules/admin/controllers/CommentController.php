<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Comment;
use app\modules\admin\models\search\CommentSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CommentController контроллер управления отзывами.
 *
 * @package app\modules\admin\controllers
 */
class CommentController extends AdminController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Список записей.
     *
     * @return string
     */
    public function actionList()
    {
        $searchModel = new CommentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render(Yii::$app->controller->action->id, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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
            'label' => 'Редактировать коментарий',
            'url' => ['/'. Yii::$app->controller->module->id .'/'. Yii::$app->controller->id .'/'. Yii::$app->controller->action->id]
        ];

        return parent::actionChange($id);
    }

    public function actionApply($id)
    {
        $model = Comment::findOne($id);

        if (!empty($model)) {
            $model->isActive = 1;
            $model->save();
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the Comment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param string $id
     *
     * @return Comment the loaded model
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Comment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
