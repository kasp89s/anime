<?php
/**
 * Вьюха Авторизации.
 *
 * @version 1.0
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>
<?php $form = ActiveForm::begin(); ?>
    <div class="form-group">
        <?= $form->field($model, 'email') ?>
    </div>
    <div class="form-group">
        <?= $form->field($model, 'password')->input('password') ?>
    </div>
        <?= Html::submitButton('Войти', ['class' => 'btn btn-primary block full-width m-b']) ?>
<?php ActiveForm::end(); ?>
