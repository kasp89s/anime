<?php
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
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
            Корзина
        </h3>
        <div class="basket-table">
            <div class="basket-row clear">
                <div class="description left">
                    <div class="image left">
                        <img src="/img/item2.png" alt="">
                    </div>
                    <div class="description-text left">
                        <p class="description-name">
                            Бэтмен. Книга 2. Город Сов
                        </p>
                        <p class="description-code">
                            Код товара: MPZ036
                        </p>
                    </div>
                </div>
                <div class="info-description right">
                    <div class="remove-button right">
                        <button>
                            <img src="/img/remove-button.png" alt="">
                        </button>
                    </div>
                    <div class="total-count right">
                        <p class="info-title">
                            Сумма:
                        </p>
                        <p>
                            250 грн
                        </p>
                    </div>
                    <div class="price right">
                        <p class="info-title">
                            Сумма:
                        </p>
                        <p>
                            250 грн
                        </p>
                    </div>
                    <div class="counter right">
                        <p class="info-title">
                            Кол-во:
                        </p>
                        <div class="counter-block left">
                            <div class="left">
                                <input type="text">
                            </div>
                            <div class="right">
                                <button class="plus"></button>
                                <button class="minus"></button>
                            </div>

                        </div>
                    </div>



                </div>
            </div>
            <div class="basket-row clear">
                <div class="description left">
                    <div class="image left">
                        <img src="/img/item2.png" alt="">
                    </div>
                    <div class="description-text left">
                        <p class="description-name">
                            Бэтмен. Книга 2. Город Сов
                        </p>
                        <p class="description-code">
                            Код товара: MPZ036
                        </p>
                    </div>
                </div>
                <div class="info-description right">
                    <div class="remove-button right">
                        <button>
                            <img src="/img/remove-button.png" alt="">
                        </button>
                    </div>
                    <div class="total-count right">
                        <p class="info-title">
                            Сумма:
                        </p>
                        <p>
                            250 грн
                        </p>
                    </div>
                    <div class="price right">
                        <p class="info-title">
                            Сумма:
                        </p>
                        <p>
                            250 грн
                        </p>
                    </div>
                    <div class="counter right">
                        <p class="info-title">
                            Кол-во:
                        </p>
                        <div class="counter-block left">
                            <div class="left">
                                <input type="text">
                            </div>
                            <div class="right">
                                <button class="plus"></button>
                                <button class="minus"></button>
                            </div>

                        </div>
                    </div>



                </div>
            </div>
            <div class="basket-row clear">
                <div class="description left">
                    <div class="image left">
                        <img src="/img/item2.png" alt="">
                    </div>
                    <div class="description-text left">
                        <p class="description-name">
                            Бэтмен. Книга 2. Город Сов
                        </p>
                        <p class="description-code">
                            Код товара: MPZ036
                        </p>
                    </div>
                </div>
                <div class="info-description right">
                    <div class="remove-button right">
                        <button>
                            <img src="/img/remove-button.png" alt="">
                        </button>
                    </div>
                    <div class="total-count right">
                        <p class="info-title">
                            Сумма:
                        </p>
                        <p>
                            250 грн
                        </p>
                    </div>
                    <div class="price right">
                        <p class="info-title">
                            Сумма:
                        </p>
                        <p>
                            250 грн
                        </p>
                    </div>
                    <div class="counter right">
                        <p class="info-title">
                            Кол-во:
                        </p>
                        <div class="counter-block left">
                            <div class="left">
                                <input type="text">
                            </div>
                            <div class="right">
                                <button class="plus"></button>
                                <button class="minus"></button>
                            </div>

                        </div>
                    </div>



                </div>
            </div>
        </div>
        <div class="payment-info clear">
            <div class="discount left">
                <p>
                    Ваша накопительная скидка составляет: 3%
                </p>
            </div>
            <div class="payment right">
                        <span>
                            Всего к оплате: <strong>1 750 грн.</strong>
                        </span>
                <button>
                    ОФОРМИТЬ ЗАКАЗ
                </button>
            </div>
        </div>

    </div>
</div>