<?php
use yii\helpers\Url;
?>
<div class="fix-size-aside left">
    <h3>
        Мой кабинет
    </h3>
    <ul>
        <?php if (!empty($this->params['user'])):?>
        <li>
            <a href="<?= Url::to('/'. Yii::$app->controller->id .'/index')?>"
                <?= (Yii::$app->controller->action->id == 'index') ? 'class="active"' : '';?>>
                Личные данные
            </a>
        </li>
        <?php endif;?>
        <?php if (!empty($this->params['user'])):?>
        <li>
            <a href="<?= Url::to('/'. Yii::$app->controller->id .'/wish-list')?>"
                <?= (Yii::$app->controller->action->id == 'wish-list') ? 'class="active"' : '';?>>
                Список желаний
            </a>
        </li>
        <?php endif;?>
        <li>
            <a href="<?= Url::to('/'. Yii::$app->controller->id .'/basket')?>"
                <?= (Yii::$app->controller->action->id == 'basket') ? 'class="active"' : '';?>>
                Корзина
            </a>
        </li>
        <?php if (!empty($this->params['user'])):?>
        <li>
            <a href="<?= Url::to('/'. Yii::$app->controller->id .'/waiting-list')?>"
                <?= (Yii::$app->controller->action->id == 'waiting-list') ? 'class="active"' : '';?>>
                Лист ожидания
            </a>
        </li>
        <?php endif;?>
        <?php if (!empty($this->params['user'])):?>
        <li>
            <a href="<?= Url::to('/'. Yii::$app->controller->id .'/orders')?>"
                <?= (Yii::$app->controller->action->id == 'orders') ? 'class="active"' : '';?>>
                Мои заказы
            </a>
        </li>
        <?php endif;?>
        <li>
            <a href="<?= Url::to('/'. Yii::$app->controller->id .'/viewed')?>"
                <?= (Yii::$app->controller->action->id == 'viewed') ? 'class="active"' : '';?>>
                Просмотренные товары
            </a>
        </li>
        <li>
            <a href="<?= Url::to('/site/logout')?>">
                Выйти
            </a>
        </li>
    </ul>
</div>
