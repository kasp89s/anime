<?php
    use yii\widgets\Breadcrumbs;
    use yii\helpers\Url;
    use yii\helpers\Html;
?>
<div class="breadcrumbs-block clearfix">
    <ul>
        <?php echo Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], 'homeLink' => false]);?>
    </ul>
</div>
<div class="content-container clearfix">
    <?= $this->render('//cabinet/block/leftNavBar', []); ?>
    <div class="responsive-container left">
        <h3>
            Личные данные
        </h3>
        <?php if (!empty($this->params['user']->code)):?>
        <div class="activate-email-block">
            <p>
                Ой, как же так, Вы не подтвердили свой E-mail:
            </p>
            <p class="confirm-email">
                <?php echo $this->params['user']->email?>
            </p>

            <div>
                <button>
                    Подтвердить
                </button>
            </div>
        </div>
        <?php endif;?>
        <div class="discount-info">
            <p>
                        <span class="title">
                            Ваша скидка:
                        </span>
                <span>
                            <?php echo $this->params['user']->group->groupDiscount?>%
                        </span>
                <a href="<?= Url::to('/page/'. $this->params['pages']['discount_system']->code)?>">
                    Узнать подробнее о системе скидок!
                </a>
            </p>
            <p>
                        <span class="title">
                            Общая сумма ваших заказов по программе
                        </span>
                <span>
                            (накопительная скидка): <?= $this->params['user']->purchaseAmount?> грн.
                        </span>
            </p>
        </div>
        <div class="user-info">
            <p>
                        <span class="title">
                            Имя:
                        </span>
                <span>
                             <?php echo $this->params['user']->fullName ?>
                        </span>
            </p>
            <p>
                        <span class="title">
                            E-mail:
                        </span>
                <span>
                             <?php echo $this->params['user']->email?>
                        </span>
            </p>
            <p>
                        <span class="title">
                            Телефоны:
                        </span>
                        <span>
                            <?php if (!empty($this->params['user']->phones)):?>
                                <?php foreach ($this->params['user']->phones as $phone):?>
                                    <?php echo $phone->phone?>
                                <?php endforeach;?>
                            <?php endif;?>
                        </span>
            </p>
            <p>
                        <span class="title">
                            Адрес доставки:
                        </span>
                        <span>
                            <?php if (!empty($this->params['user']->address)):?>
                                <?php foreach ($this->params['user']->address as $address):?>
                                        <?= $address->city?> <?= $address->address?> <?= $address->zip?> <br />
                                <?php endforeach;?>
                            <?php endif;?>
                        </span>
            </p>
        </div>
        <a href="<?= Url::to('/'. Yii::$app->controller->id .'/change')?>" class="edit">
            РЕДАКТИРОВАТЬ
        </a>
        <?php if(!empty($purchasedProducts)):?>
        <div class="help-block">
            <p>
                Помогите сделать наш сервис лучше!
            </p>
            <span>
                        Оставьте отзыв о купленных товарах
                    </span>
        </div>
        <div class="random-product ">
            <?php foreach ($purchasedProducts as $orderProduct):?>
            <div class="product">
                <a href="<?= Url::to('/product/' . $orderProduct->product->id)?>">
                    <?= Html::img('/uploads/product/' . $orderProduct->product->id .'/' . $orderProduct->product->imageFileName, []);?>
                </a>
            </div>
            <?php endforeach;?>
        </div>
        <?php endif;?>
    </div>
</div>
