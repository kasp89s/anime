<?php
namespace app\modules\admin\controllers;

use app\models\Coupon;
use Yii;
use yii\data\Pagination;
use app\modules\admin\models\search\CouponSearch;
use yii\web\NotFoundHttpException;

/**
 * CouponController Контроллер управления скидочными купонами.
 *
 * @package app\modules\admin\controllers
 */
class CouponController extends AdminController {

    /**
     * Список записей.
     *
     * @return string
     */
    public function actionList()
    {
        $searchModel = new CouponSearch();
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
            'label' => 'Создать купон',
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
            'label' => 'Редактировать купон',
            'url' => ['/'. Yii::$app->controller->module->id .'/'. Yii::$app->controller->id .'/'. Yii::$app->controller->action->id]
        ];

        if (Yii::$app->request->isPost) {
            $this->_post['Coupon']['updateTime'] = date('Y-m-d H:i:s', time());
            $this->_post['Coupon']['updateUserId'] = \Yii::$app->user->id;
        }

        return parent::actionChange($id);
    }

    /**
     * Finds the Coupon model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Coupon the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Coupon::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
