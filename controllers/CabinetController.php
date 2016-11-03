<?php
/**
 *
 *
 * @version 1.0
 */
namespace app\controllers;

use Yii;
use app\models\Category;
use app\models\LoginForm;
use \BW\Vkontakte as Vk;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;
class CabinetController extends AbstractController
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
            'label' => ' Мой кабинет',
            'url' => ['/cabinet']
        ];
    }

    /**
     * Главная.
     *
     * @return string
     */
    public function actionIndex()
    {
        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => ' Личные данные',
            'url' => ['/cabinet']
        ];

        if (Yii::$app->request->isAjax && $this->user->load(Yii::$app->request->post()) && $this->user->address->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return array_merge(ActiveForm::validate($this->user), ActiveForm::validate($this->user->address));
        }

        if (
            $this->user->load(Yii::$app->request->post()) && $this->user->validate() &&
            $this->user->address->load(Yii::$app->request->post()) && $this->user->address->validate()
        ) {
            $this->user->save();
            $this->user->address->save();
        }

        return $this->render('index', [
        ]);
    }
}
