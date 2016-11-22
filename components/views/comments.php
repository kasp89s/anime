<?php 
use yii\helpers\Html;
use app\models\User;
use yii\widgets\ActiveForm;

$comment = new \app\models\Comment();
?>
<div class="last-comments left">
    <?php if (!empty($model->comments)):?>
    <h4>
        Последние отзывы
    </h4>
        <?php foreach($model->comments as $comment):?>
            <div class="comments-row">
        <div class="comments-row-info">
                            <span class="name">
                                <?= $comment->userName?>
                            </span>
            <ul class="rating">
                <?= str_repeat('<li class="active"></li>', $comment->rating)?><?= str_repeat('<li></li>', 5 - $comment->rating)?>
            </ul>
            <span class="time"><?= \app\models\Comment::getDate($comment->date)?></span>
            <p><?= $comment->message ?></p>
        </div>
    </div>
        <?php endforeach;?>
    <?php endif;?>
</div>
<div class="add-comments right">
    <h4>
        Напишите свой отзыв
    </h4>
    <?php $form = ActiveForm::begin([
            'action' => '',
            'enableAjaxValidation' => true,
            'options'=>['class'=>''],
            'fieldConfig' => [
                'template' => '<p>{label}</p>{input}{error}',
                'errorOptions' => ['class' => 'error text-danger'],
                'labelOptions' => ['class' => ''],
                'inputOptions' => ['class' => ''],
                'options' => [
                    'tag' => 'div',
                ],
            ],
        ]); ?>

    <?= $form->field($comment, 'productId')->hiddenInput(['value' => $model->id])->label(false) ?>

    <?= $form->field($comment, 'rating')->hiddenInput(['value' => 4])->label(false) ?>

    <?= $form->field($comment, 'message')->textArea(['placeholder' => 'Ваш отзыв', 'value' => ''])->label(false) ?>

    <?= $form->field($comment, 'userName')->input('text', ['value' => !empty($this->params['user']->address->fullName) ? $this->params['user']->address->fullName : '']) ?>

    <?= $form->field($comment, 'userEmail')->input('email', ['value' => !empty($this->params['user']->email) ? $this->params['user']->email : '']) ?>

    <div class="comments-control clearfix">
        <div class="left">
            <span>Оценка</span>
            <ul class="rating active">
                <li class="active"></li>
                <li class="active"></li>
                <li class="active"></li>
                <li class="active"></li>
                <li></li>
            </ul>
        </div>
        <?= Html::submitButton('Добавить отзыв', ['class' => 'add right']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
