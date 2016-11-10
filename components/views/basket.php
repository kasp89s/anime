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
                                <?php endif;?>
                            </a>
						</span>
</div>
