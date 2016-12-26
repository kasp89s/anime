<?php
namespace app\modules\admin\controllers;

use app\models\Discount;
use Yii;
use yii\data\Pagination;
use app\modules\admin\models\search\DiscountSearch;
use yii\web\NotFoundHttpException;

/**
 * DiscountController Контроллер управления скидками.
 *
 * @package app\modules\admin\controllers
 */
class DiscountController extends AdminController {

    /**
     * Список записей.
     *
     * @return string
     */
    public function actionList()
    {
        $searchModel = new DiscountSearch();
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
            'label' => 'Создать скидку',
            'url' => ['/'. Yii::$app->controller->module->id .'/'. Yii::$app->controller->id .'/'. Yii::$app->controller->action->id]
        ];

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
            'label' => 'Редактировать скидку',
            'url' => ['/'. Yii::$app->controller->module->id .'/'. Yii::$app->controller->id .'/'. Yii::$app->controller->action->id]
        ];

        return parent::actionChange($id);
    }

    /**
     * Finds the Discount model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Discount the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Discount::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
