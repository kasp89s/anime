<?php
/**
 * Футер.
 *
 * @version 1.0
 */
use yii\helpers\Url;
?>
<footer>
    <div class="clearfix">
        <div class="col-lg-4 col-md-4 shop-items">
            <div>
                <h3>
                    Магазин
                </h3>
                <?php if(!empty($this->params['categories'])):?>
                <ul class="shop">
                    <?php foreach ($this->params['categories'] as $category):?>
                    <li>
                        <a href="<?= Url::to('/category/' . $category->id)?>"><?= $category->name?></a>
                    </li>
                    <?php endforeach;?>
                </ul>
                <?php endif;?>
            </div>
            <div>
                <h3>
                    Помощь
                </h3>
                <?php if ($this->params['pages']):?>
                <ul class="shop">
                    <?php foreach ($this->params['pages'] as $page):?>
                        <li><a href="<?= Url::to('/page/'. $page->code)?>"><?= $page->title ?></a></li>
                    <?php endforeach;?>
                </ul>
                <?php endif;?>
            </div>

        </div>
        <div class="col-lg-2 col-md-2 footer-social">
            <h3>
                Социальные сети
            </h3>
            <ul class="clearfix">
                <li>
                    <a href="<?= Yii::$app->params['social']['facebook']['link']?>" class="fb"></a>
                </li>
                <li>
                    <a href="<?= Yii::$app->params['social']['vk']['link']?>" class="vk"></a>
                </li>
                <li>
                    <a href="<?= Yii::$app->params['social']['twitter']['link']?>" class="twiter"></a>
                </li>
                <li>
                    <a href="<?= Yii::$app->params['social']['in']['link']?>"  class="instagram"></a>
                </li>
                <li>
                    <a href="<?= Yii::$app->params['social']['youtube']['link']?>" class="youtube"></a>
                </li>
            </ul>
            <p>
                Расскажи о нас своим друзьям!
            </p>
            <div class="widget-block">
                <img src="/img/share.png" alt="">
            </div>

        </div>
        <div class="col-lg-3 col-md-3 subscribe">
            <h3>
                Подпишись на наши новости
            </h3>
            <p>
                Подпишись на новости магазина чтобы быть вкурсе новых поступлений и акций и скидок.
            </p>

            <form action="">
                <input type="text" placeholder="Введи свой E-mail">
                <button>
                    ПОДПИСАТЬСЯ
                </button>
            </form>
        </div>
        <div class="col-lg-3 col-md-3 social-widget">
            <div class="">
                <img src="/img/subscribe.png" alt="">
            </div>
        </div>
    </div>
    <div class="clearfix">

        <div class="col-lg-12  copyright">
                            <span>
                                 ©2008-2016, Интернет магазин комиксов и манги «Anime Line Group»
                            </span>
            <span class="designer">
                                Дизайн -
                                <a href="#">ЮДЖИН INK</a>
                            </span>
        </div>
    </div>
</footer>
