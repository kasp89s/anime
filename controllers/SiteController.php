<?php
/**
 * Базовый контроллер сайта.
 *
 * @version 1.0
 */
namespace app\controllers;

use app\models\InfoPage;
use app\models\News;
use app\models\NewsLetterSubscriber;
use app\models\OrderProduct;
use app\models\PaymentMethod;
use app\models\Product;
use app\models\ProductCategoryRelation;
use app\models\ProductSpecificationRelation;
use app\models\QuickOrderForm;
use app\models\ShippingMethod;
use app\models\WishList;
use Yii;
use app\models\Banner;
use app\models\Category;
use \BW\Vkontakte as Vk;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Comment;
use yii\web\Response;
use yii\widgets\ActiveForm;

class SiteController extends AbstractController
{
    public $layout = 'main';

    public $facebook;

    public $vk;

    public function behaviors()
    {
        return [
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
            'scope' => ['email'],
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
        $slides = Banner::find()
            ->where(['isActive' => 1])
            ->andWhere('startTime <= :time AND endTime >= :time', [':time' => date('Y-m-d H:i:s', time())])
            ->all();
        $news = News::find()->where(['isActive' => 1])->limit(4)->orderBy('publishTime desc')->all();

        $newProducts = Product::find()
            ->joinWith('discount')
            ->joinWith('marker')
            ->where('productmarker.isActive = 1 AND productmarker.isSale = 1 AND productmarker.isNew = 1')
            ->orderBy('id desc')
            ->limit(10)
            ->all();

        $popularProducts = OrderProduct::find()
            ->select('orderproduct.`productId`, COUNT(orderproduct.`productId`) as `count`')
            ->joinWith('product')
            ->joinWith('product.discount')
            ->joinWith('product.marker')
            ->groupBy('orderproduct.productId')
            ->orderBy('count desc')
            ->limit(10)
            ->all();

        $overstock = Product::find()
            ->joinWith('discount')
            ->joinWith('marker')
            ->where('productmarker.isActive = 1 AND productmarker.isSale = 1 AND productmarker.isNew = 1 AND productdiscount.value > 0')
            ->orderBy('id desc')
            ->limit(10)
            ->all();

        $quick = Category::find()->where([
                'isActive' => 1,
                'isInQuickLink' => 1
            ])->all();
        return $this->render(Yii::$app->controller->action->id, [
            'slides' => $slides,
            'news' => $news,
            'quick' => $quick,
            'newProducts' => $newProducts,
            'popularProducts' => $popularProducts,
            'overstock' => $overstock,
            'viewProductList' => $this->getLastViewListProduct(),
        ]);
    }

    public function actionCategory($id)
    {
        //Yii::$app->cache
        $category = Category::findOne($id);
        if (empty($category))
            throw new \yii\web\NotFoundHttpException();

        $query = Product::find();
        $query->joinWith('categoryRelation');
        $query->joinWith('marker');
        $query->joinWith('discount');
        $query->where(['productcategoryrelation.productCategoryId' => $id]);
        $query->andWhere('productmarker.isActive = 1 AND productmarker.isSale = 1');

        if (!empty($_GET['time']))
            $query->orderBy('updateTime desc');

        if (!empty($_GET['price_d']))
            $query->orderBy('price desc');

        if (!empty($_GET['price_a']))
            $query->orderBy('price asc');

        if (!empty($_GET['name_a']))
            $query->orderBy('name asc');

        if (!empty($_GET['name_d']))
            $query->orderBy('name desc');

        if (!empty($_GET['stock']))
            $query->orderBy('quantityInStock desc');

        if (!empty($_GET['sold']))
            $query->orderBy('quantityOfSold desc');

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 20]);
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
            'productBlocks' => array_chunk($products, 5),
            'pages' => $pages,
        ]);
    }

    public function actionProduct($id)
    {
        $comment = new Comment();
        if (Yii::$app->request->isAjax && $comment->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($comment);
        }

        if ($comment->load(Yii::$app->request->post()) && $comment->validate()) {
            $comment->save();
        }

        $product = Product::findOne($id);
        if (empty($product))
            throw new \yii\web\NotFoundHttpException();

        $this->setLastViewProduct($id);

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

        $isWish = false;
        if (!empty($this->user->id)) {
            $isWish = WishList::find()->where([
                'productId' => $product->id,
                'customerId' => $this->user->id,
            ])->count();
        }

        return $this->render(Yii::$app->controller->action->id, [
            'product' => $product,
            'isWish' => $isWish,
            'viewProductList' => $this->getLastViewListProduct(),
            'shippingMethods' => $shippingMethods,
            'paymentMethods' => $paymentMethods,
            'quickOrder' => new QuickOrderForm(),
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

    public function actionSubscribe()
    {
        $model = new NewsLetterSubscriber();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->customerId = !empty($this->user->id) ? $this->user->id : 0;
            $model->code = uniqid();
            $model->save();

            $this->sendEmail(
                $model->email,
                Yii::$app->params['NewsLetterSubscriberSubject'],
                $this->renderPartial('emailTemplates/subscribe', ['model' => $model])
            );
        }

        return $this->render(Yii::$app->controller->action->id, [
            'model' => $model
        ]);
    }

    public function actionSubscribeApprove($code)
    {
        $model = NewsLetterSubscriber::find()->where(['code' => $code])->one();
        if (empty($model))
            throw new \yii\web\NotFoundHttpException();

        $model->code = null;
        $model->isActive = 1;

        $model->save();

        return $this->render(Yii::$app->controller->action->id, []);
    }

    public function actionDeactivationSubscribe($id)
    {
        $model = NewsLetterSubscriber::findOne($id);
        if (empty($model))
            throw new \yii\web\NotFoundHttpException();

        $model->delete();

        return $this->render(Yii::$app->controller->action->id, []);
    }
}
