<?php
/**
 * Хедер с меню.
 *
 * @version 1.0
 */
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$recover = new \app\models\RecoverForm();
?>
<header class="clearfix">
    <div class="logo col-xs-12 col-sm-4 col-md-2">
        <a href="/"><img src="/img/logo.png" alt=""></a>
    </div>
    <div class="panel col-xs-12 col-sm-8 col-md-3 col-lg-4">
        <div class="account">
						<span>
							Личный кабинет
                            <?php if (empty($this->params['user'])):?>
							<a href="/" class="open-build-in" data-popup="#enter-modal">Войдите в личный кабинет</a>
                            <?php else:?>
                            <span class="user-login show">
                                Привет, <?= !empty($this->params['user']->address->fullName) ? $this->params['user']->address->fullName : $this->params['user']->email?>
                            </span>
                            <?php endif;?>
						</span>
            <div class="build-in-popup" id="recover-password">
                <h2>Вход в anime line group</h2>
                <div class="table">
                    <?php $form = ActiveForm::begin([
                            'action' => '/site/recover',
                            'enableAjaxValidation' => true,
                            'options'=>['class'=>'row'],
                            'fieldConfig' => [
                                'template' => '{label}{input}{error}',
                                'errorOptions' => ['class' => 'error text-danger'],
                                'labelOptions' => ['class' => ''],
                                'inputOptions' => ['class' => 'input'],
                                'options' => [
                                    'tag' => 'div',
                                ],
                            ],
                        ]); ?>
                        <?= $form->field($recover, 'email') ?>
                        <?= Html::submitButton('Отправить новый пароль', ['class' => 'button submit']) ?>
                        <a href="javascript:void(0)" class="cancel open-build-in" data-popup="#recover-password">Я вспомнил свой пароль</a>
                    <?php ActiveForm::end(); ?>
                    <div class="login">
                        <a href="">Войдите как пользователь</a>
                        <a href=""><img src="/img/login-fb.png" alt=""></a>
                        <a href=""><img src="/img/login-vk.png" alt=""></a>
                        <a href="">Зарегестрироваться</a>
                    </div>
                </div>
            </div>
            <div class="build-in-popup" id="enter-modal">
                <div class="close right open-build-in" data-popup="#enter-modal">
                    <img src="/img/remove-button.png" alt="">
                </div>

                <h2>Вход в anime line group</h2>
                <div class="table">
                    <?php $form = ActiveForm::begin([
                            'action' => '/site/login',
                            'enableAjaxValidation' => true,
                            'options'=>['class'=>'row'],
                            'fieldConfig' => [
                                'template' => '{label}{input}{error}',
                                'errorOptions' => ['class' => 'error text-danger'],
                                'labelOptions' => ['class' => ''],
                                'inputOptions' => ['class' => 'input'],
                                'options' => [
                                    'tag' => 'div',
                                ],
                            ],
                        ]); ?>
                        <?= $form->field($this->params['login'], 'email') ?>

                        <?= $form->field($this->params['login'], 'password')->input('password') ?>

                        <a class="forgot-password open-build-in"  href="javascript:void()" data-popup="#recover-password">Напомнить пароль</a>

                        <div class="enter-row">
                            <?= Html::submitButton('ВОЙТИ', ['class' => 'button submit']) ?>
                            <button class="cancel open-build-in" data-popup="#enter-modal">Отмена</button>
                        </div>
                    <?php ActiveForm::end(); ?>
                    <div class="login">
                        <a href="javascript:void()">Войдите как пользователь</a>
                        <div class="social-enter">
                            <a href="<?= $this->params['facebook']->getRedirectLoginHelper()->getLoginUrl('http://' . Yii::$app->getRequest()->serverName . '/social/facebook', ['email'])?>">
                                <img src="/img/login-fb.png" alt="">
                            </a>
                            <a href="<?= $this->params['vk']->getLoginUrl()?>">
                                <img src="/img/login-vk.png" alt="">
                            </a>
                        </div>

                        <a class="registration" href="javascript:void()">Зарегестрироваться</a>
                    </div>
                </div>
            </div>
        </div>
        <?= \app\components\BasketWidget::widget(['model' => $this->params['basket']]) ?>
    </div>
    <div class="info col-xs-12 col-md-7 col-lg-6">
        <div class="worktime">
            Время работы: пн-вс. с 10:00 до 18:00 / +38 (063) <span>467-27-36</span>
            <a href="<?= Url::to('/'. $this->params['pages']['contacts']->code)?>">все контакты</a>
        </div>
        <form action="" class="search">
            <input type="text" name="s" placeholder="ПОИСК ПО САЙТУ">
            <button type="submit"></button>
        </form>
        <div class="example">
            Напиши то, что хочешь найти. Например: Черепашки ниндзя
        </div>
    </div>
    <div class="clearfix"></div>
    <button class="menu-button">
        <i></i><i></i><i></i>
    </button>
    <ul class="menu col-xs-12">
        <li>
            <a href="<?= Url::to('/news')?>">Новости</a>
        </li>
        <?php if(!empty($this->params['categories'])):?>
            <?php foreach ($this->params['categories'] as $category):?>
                <li>
                    <a href="<?= Url::to('/category/' . $category->id)?>"><?= $category->name?></a>
                    <?php if (!empty($category->categories) || !empty($category->options) || !empty($category->specifications)):?>
                        <div class="sub-menu">
                            <div class="table">
                                <div class="category">
                                    <?php if (!empty($category->categories)):?>
                                    <ul>
                                        <li><a href="javascript:void(0)">Категории</a></li>
                                        <?php foreach ($category->categories as $subCategory):?>
                                            <li><a href="<?= Url::to('/category/' . $subCategory->id)?>"><?= $subCategory->name?></a></li>
                                        <?php endforeach;?>
                                    </ul>
                                    <?php endif;?>
<!--                                    --><?php //if (!empty($category->options)):?>
<!--                                        --><?php //foreach ($category->options as $option):?>
<!--                                            <ul>-->
<!--                                                <li><a href="javascript:void(0)">--><?//= $option->name?><!--</a></li>-->
<!--                                                --><?php //if (!empty($option->values)):?>
<!--                                                    --><?php //foreach ($option->values as $value):?>
<!--                                                        <li><a href="--><?//= Url::to('/option/value/' . $value->id)?><!--">--><?//= $value->name?><!--</a></li>-->
<!--                                                    --><?php //endforeach;?>
<!--                                                --><?php //endif;?>
<!--                                              </ul>-->
<!--                                        --><?php //endforeach;?>
<!--                                    --><?php //endif;?>
         <!--                           <?php /*if (!empty($category->specifications)):*/?>
                                    <ul>
                                            <?php /*foreach ($category->specifications as $specification):*/?>
                                                <li><a href="<?/*= Url::to('/specification/' . $specification->id)*/?>"><?/*= $specification->name*/?></a></li>
                                            <?php /*endforeach;*/?>
                                     </ul>
                                    --><?php /*endif;*/?>
                                </div>
                            </div>
                        </div>
                    <?php endif;?>
                </li>
            <?php endforeach;?>
        <?php endif;?>
    </ul>
</header>
