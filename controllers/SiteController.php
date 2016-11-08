<?php
/**
 * Базовый контроллер сайта.
 *
 * @version 1.0
 */
namespace app\controllers;

use app\models\InfoPage;
use app\models\News;
use app\models\PaymentMethod;
use app\models\Product;
use app\models\ProductCategoryRelation;
use app\models\ShippingMethod;
use Yii;
use app\models\Banner;
use app\models\Category;
use \BW\Vkontakte as Vk;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\LoginForm;

class SiteController extends AbstractController
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
    }

    /**
     * Главная.
     *
     * @return string
     */
    public function actionIndex()
    {
        $slides = Banner::find()->where(['isActive' => 1])->all();
        $news = News::find()->where(['isActive' => 1])->limit(4)->orderBy('publishTime desc')->all();

        return $this->render(Yii::$app->controller->action->id, [
            'slides' => $slides,
            'news' => $news,
        ]);
    }

    public function actionCategory($id)
    {
        $category = Category::findOne($id);
        if (empty($category))
            throw new \yii\web\NotFoundHttpException();

//        $productsRelation = ProductCategoryRelation::find()->all();

        $query = Product::find();
        $query->joinWith('categoryRelation');
        $query->joinWith('marker');
        $query->where(['productcategoryrelation.productCategoryId' => $id]);
        $query->andWhere('productmarker.isActive = 1 AND productmarker.isSale = 1');
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 5]);
        $pages->pageSizeParam = false;
        $products = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => " {$category->name}",
            'url' => false
        ];

        return $this->render(Yii::$app->controller->action->id, [
            'category' => $category,
            'products' => $products,
            'pages' => $pages,
        ]);
    }

    public function actionProduct($id)
    {
        $product = Product::findOne($id);
        if (empty($product))
            throw new \yii\web\NotFoundHttpException();

        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => " {$product->categories[0]->name}",
            'url' => ['/category/' . $product->categories[0]->id]
        ];

        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => " {$product->name}",
            'url' => false
        ];

        $shippingMethods = ShippingMethod::find()->all();

        $paymentMethods = PaymentMethod::find()->all();

        return $this->render(Yii::$app->controller->action->id, [
            'product' => $product,
            'shippingMethods' => $shippingMethods,
            'paymentMethods' => $paymentMethods,
        ]);
    }

    public function actionStatic($url)
    {
        $page = InfoPage::find()->where(['code' => $url])->one();

        if (empty($page))
            throw new \yii\web\NotFoundHttpException();

        Yii::$app->view->params['breadcrumbs'][] = [
            'template' => "<li>{link}</li>\n",
            'label' => " {$page->title}",
            'url' => false
        ];

        return $this->render(Yii::$app->controller->action->id, [
            'page' => $page
        ]);
    }
}
