<?php
use yii\helpers\Url;
?>
<div class="cart">
						<span>
							Моя корзина
							<a href="<?= Url::to('/cabinet/basket') ?>">
                                <?php if (empty($model->basketProducts)):?>
                                Ваша корзина пуста
                                <?php else:?>
									<?= \Yii::t('app', '{n, plural, =0{Ваша корзина пуста} =1{В корзине # товар} few{В корзине # товара} many{В корзине # товаров}}', ['n' => count($model->basketProducts)]);?>
                                <?php endif;?>
                            </a>
						</span>
</div>
