<?php
    use yii\helpers\Url;
?>
<nav class="navbar-default navbar-static-side" role="navigation">
<div class="sidebar-collapse">
<ul class="nav metismenu" id="side-menu">
<li class="nav-header">
    <div class="profile-element"> <span>
                            <img alt="image" class="img-circle" src="/img/logo.png"/>
                             </span>
        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong
                                        class="font-bold"><?= \Yii::$app->user->getIdentity()->email ?></strong>
                             </span> <span class="text-muted text-xs block"> ... </span> </span> </a>
    </div>
    <div class="logo-element">
        IN+
    </div>
</li>
<li <?php echo (Yii::$app->controller->id == 'user' || Yii::$app->controller->id == 'group') ? 'class="active"' : '';?>>
    <a href="javascript:void(0)"><i class="fa fa-male"></i> <span class="nav-label">Пользователи</span> <span
            class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li <?php echo (Yii::$app->controller->id == 'user') ? 'class="active"' : '';?>>
            <a href="<?= Url::to('/admin/user/list')?>">Список пользователей</a>
        </li>
        <li <?php echo (Yii::$app->controller->id == 'group') ? 'class="active"' : '';?>>
            <a href="<?= Url::to('/admin/group/list')?>">Группы пользователей</a>
        </li>
    </ul>
</li>
<li <?php echo (Yii::$app->controller->id == 'customer' || Yii::$app->controller->id == 'customer-group') ? 'class="active"' : '';?>>
    <a href="javascript:void(0)"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Клииенты</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li <?php echo (Yii::$app->controller->id == 'customer') ? 'class="active"' : '';?>>
            <a href="<?= Url::to('/admin/customer/list')?>">Список клиентов</a>
        </li>
        <li <?php echo (Yii::$app->controller->id == 'customer-group') ? 'class="active"' : '';?>>
            <a href="<?= Url::to('/admin/customer-group/list')?>">Группы клиентов</a>
        </li>
    </ul>
</li>
<li <?php echo (Yii::$app->controller->id == 'banner') ? 'class="active"' : '';?>>
    <a href="<?= Url::to('/admin/banner/list')?>"><i class="fa fa-youtube-play"></i> <span class="nav-label">Банер</span> </a>
</li>
    <li <?php echo (Yii::$app->controller->id == 'info-page') ? 'class="active"' : '';?>>
    <a href="<?= Url::to('/admin/info-page/list')?>"><i class="fa fa-eye"></i> <span class="nav-label">Страници</span> </a>
</li>
<li <?php echo (Yii::$app->controller->id == 'manufacture') ? 'class="active"' : '';?>>
    <a href="<?= Url::to('/admin/manufacture/list')?>"><i class="fa fa-home"></i> <span class="nav-label">Производители</span> </a>
</li>
<li <?php echo (Yii::$app->controller->id == 'discount') ? 'class="active"' : '';?>>
    <a href="<?= Url::to('/admin/discount/list')?>"><i class="fa fa-angellist"></i> <span class="nav-label">Скидки</span> </a>
</li>
    <li <?php echo (Yii::$app->controller->id == 'coupon') ? 'class="active"' : '';?>>
    <a href="<?= Url::to('/admin/coupon/list')?>"><i class="fa fa-cc"></i> <span class="nav-label">Купоны</span> </a>
</li>
    <li <?php echo (Yii::$app->controller->id == 'shipping-method') ? 'class="active"' : '';?>>
    <a href="<?= Url::to('/admin/shipping-method/list')?>"><i class="fa fa-truck"></i> <span class="nav-label">Способы доставки</span> </a>
</li>
    <li <?php echo (Yii::$app->controller->id == 'payment-method') ? 'class="active"' : '';?>>
    <a href="<?= Url::to('/admin/payment-method/list')?>"><i class="fa fa-cc-visa"></i> <span class="nav-label">Способы оплаты</span> </a>
</li>
    <li <?php echo (Yii::$app->controller->id == 'news') ? 'class="active"' : '';?>>
    <a href="<?= Url::to('/admin/news/list')?>"><i class="fa fa-h-square"></i> <span class="nav-label">Новости</span> </a>
</li>
<li <?php echo (Yii::$app->controller->id == 'product') ? 'class="active"' : '';?>>
    <a href="<?= Url::to('/admin/product/list')?>"><i class="fa fa-cutlery"></i> <span class="nav-label">Товары</span> </a>
</li>
    <li <?php echo (
        Yii::$app->controller->id == 'category' ||
        Yii::$app->controller->id == 'specification' ||
        Yii::$app->controller->id == 'option'
    ) ? 'class="active"' : '';?>>
    <a href="javascript:void(0)"><i class="fa fa-sitemap"></i> <span class="nav-label">Категории</span> <span
            class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li <?php echo (Yii::$app->controller->id == 'category') ? 'class="active"' : '';?>>
            <a href="<?= Url::to('/admin/category/list')?>">Список категорий</a>
        </li>
        <li <?php echo (Yii::$app->controller->id == 'specification') ? 'class="active"' : '';?>>
            <a href="<?= Url::to('/admin/specification/list')?>">Список спецификаций</a>
        </li>
        <li <?php echo (Yii::$app->controller->id == 'option') ? 'class="active"' : '';?>>
            <a href="<?= Url::to('/admin/option/list')?>">Список опций (атрибутов)</a>
        </li>
    </ul>
</li>
</ul>

</div>
</nav>
