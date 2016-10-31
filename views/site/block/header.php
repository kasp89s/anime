<?php
/**
 * Хедер с меню.
 *
 * @version 1.0
 */
use yii\helpers\Url;
?>
<header class="clearfix">
    <div class="logo col-xs-12 col-sm-4 col-md-2">
        <img src="/img/logo.png" alt="">
    </div>
    <div class="panel col-xs-12 col-sm-8 col-md-3 col-lg-4">
        <div class="account">
						<span>
							Личный кабинет
							<a href="/" class="open-build-in" data-popup="#recover-password">Войдите в личный кабинет</a>
						</span>
            <div class="build-in-popup" id="recover-password">
                <h2>Вход в anime line group</h2>
                <div class="table">
                    <form action="">
                        E-mail
                        <input type="email" class="input">
                        <button type="input" class="button submit">Отправить новый пароль</button>
                        <a href="">Я вспомнил свой пароль</a>
                    </form>
                    <div class="login">
                        <a href="">Войдите как пользователь</a>
                        <a href=""><img src="/img/login-fb.png" alt=""></a>
                        <a href=""><img src="/img/login-vk.png" alt=""></a>
                        <a href="">Зарегестрироваться</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="cart">
						<span>
							Моя корзина
							<a href="">Ваша корзина пуста</a>
						</span>
        </div>
    </div>
    <div class="info col-xs-12 col-md-7 col-lg-6">
        <div class="worktime">
            Время работы: пн-вс. с 10:00 до 18:00 / +38 (063) <span>467-27-36</span> <a href="">все контакты</a>
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
            <a href="">Новости</a>
        </li>
        <li>
            <a href="">Все книги</a>
            <div class="sub-menu">
                <div class="table">
                    <div class="category">
                        <ul>
                            <li><a href="">Категории</a></li>
                            <li><a href="">Комиксы</a></li>
                            <li><a href="">Манга</a></li>
                            <li><a href="">Артбуки</a></li>
                            <li><a href="">Книги</a></li>
                        </ul>
                        <ul>
                            <li><a href="">Язык</a></li>
                            <li><a href="">На русском</a></li>
                            <li><a href="">На английском</a></li>
                            <li><a href="">На японском</a></li>
                        </ul>
                        <ul>
                            <li><a href="">Обложка</a></li>
                            <li><a href="">Мягкий переплет</a></li>
                            <li><a href="">Твердый переплет</a></li>
                            <li><a href="">Синглы (журналы)</a></li>
                        </ul>
                        <ul>
                            <li><a href="">Сеты книг</a></li>
                            <li><a href="">Сеты комиксов</a></li>
                            <li><a href="">Сеты манги</a></li>
                            <li><a href="">Сеты книг</a></li>
                        </ul>
                    </div>
                    <div class="interesting">
                        <ul>
                            <li><a href="">Интересное</a></li>
                            <li><a href="">Абсолютные издания</a></li>
                            <li><a href="">Ашет-коллекция</a></li>
                            <li><a href="">Черепашки ниндзя</a></li>
                            <li><a href="">Saga. Сага</a></li>
                            <li><a href="">Скотт Пилигрим</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <a href="">Одежда</a>
        </li>
        <li>
            <a href="">Аксессуары</a>
        </li>
        <li>
            <a href="">Кружки</a>
        </li>
        <li>
            <a href="">Игрушки</a>
        </li>
        <li>
            <a href="">Еда</a>
        </li>
        <li>
            <a href="">Все остальное</a>
        </li>
        <li>
            <a href="">Новинки</a>
        </li>
        <li>
            <a href="">Предзаказ</a>
        </li>
    </ul>
</header>