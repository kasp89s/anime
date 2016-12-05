<?php
/**
 *
 *
 * @version 1.0
 */
namespace app\controllers;

use app\models\News;
use Yii;
use app\models\Category;
use app\models\LoginForm;
use \BW\Vkontakte as Vk;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;
class NewsController extends AbstractController
{
    public $layout = 'main';

    public $facebook;

    public $vk;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function init()
    {
        parent::init();

        $this->facebook = new \Facebook\Facebook([
            'app_id' => Yii::$app->params['social']['facebook']['id'],
            'app_secret' => Yii::$app->params['social']['facebook']['secret'],
        ]);

        $this->vk = new Vk([
            'client_id' => Yii::$app->params['social']['vk']['id'],
            'client_secret' => Yii::$app->params['social']['vk']['secret'],
            'redirect_uri' => 'http://' . Yii::$app->getRequest()->serverName . '/social/vk',
        ]);

        Yii::$app->view->params['vk'] = $this->vk;
        Yii::$app->view->params['facebook'] = $this->facebook;
        Yii::$app->view->params['user'] = $this->user;

        Yii::$app->view->params['categories'] = Category::find()
            ->where(['isActive' => 1])
            ->andWhere(['level' => 0])
            ->orderBy('sortOrder', SORT_DESC)
            ->all();

        Yii::$app->view->params['login'] = new LoginForm();

        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => ' Новости',
            'url' => ['/news']
        ];
    }

    /**
     * Главная.
     *
     * @return string
     */
    public function actionIndex()
    {
        $query = News::find()->where(['isActive' => 1]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 5]);
        $pages->pageSizeParam = false;
        $query->offset($pages->offset)->limit($pages->limit);

        if (!empty($_GET['time']))
            $query->orderBy('publishTime desc');

        if (!empty($_GET['view']))
            $query->orderBy('publishTime desc');

        $records = $query->all();

        foreach ($records as $record) {
            $record->products;
        }

        return $this->render(Yii::$app->controller->action->id, [
            'records' => $records,
            'pages' => $pages,
            'count' => $query->count(),
        ]);
    }

    public function actionItem($id)
    {
        $record = News::findOne($id);

        if (empty($record))
            throw new \yii\web\NotFoundHttpException();

        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => ' ' . $record->title,
            'url' => false
        ];

        return $this->render(Yii::$app->controller->action->id, [
            'record' => $record,
            'viewProductList' => $this->getLastViewListProduct(),
        ]);
    }
}
