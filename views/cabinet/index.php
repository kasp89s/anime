<?php
    use yii\widgets\Breadcrumbs;
    use yii\helpers\Url;
    use yii\widgets\ActiveForm;
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
            Редактирование личных данных
        </h3>
        <div class="edit-form">
            <?php $form = ActiveForm::begin([
                'action' => '/cabinet',
                'enableAjaxValidation' => true,
                'options'=>['class'=>'row'],
                'fieldConfig' => [
                    'template' => '{label}<div class="info left">{input}</div>{error}',
                    'errorOptions' => ['class' => 'error text-danger'],
                    'labelOptions' => ['class' => 'label left'],
                    'inputOptions' => ['class' => ''],
                    'options' => [
                        'tag' => 'div',
                        'class' => 'form-row clearfix',
                    ],
                ],
            ]); ?>

            <?= $form->field($this->params['user']->address, 'fullName') ?>

            <?= $form->field($this->params['user'], 'email') ?>

            <?= $form->field($this->params['user']->address, 'phone1') ?>

            <?php if (empty($this->params['user']->address->phone2)):?>
            <div class="form-row clearfix new-number">
                <?= Html::activeTextInput($this->params['user']->address, 'phone2', ['placeholder' => 'Например, (066) 123-23-32']) ?>
                <button class="remove-number-block">
                    <img src="img/remove-button.png" alt="">
                </button>
            </div>
                <div class="form-row clearfix">
                        <span class="add-number" onclick="$(this).closest('.form-row.clearfix').hide()">
                            Добавить еще один +
                        </span>
                </div>
                <?php else:?>
                <?= $form->field($this->params['user']->address, 'phone2') ?>
            <?php endif;?>

            <?= $form->field($this->params['user']->address, 'address') ?>

<!--            <div class="form-row clearfix new-address">
                <label>
                    <select>
                        <option selected> Киев</option>
                        <option>Чернигов</option>
                        <option>Минск</option>
                    </select>
                </label>
                <button class="remove-address-block">
                    <img src="img/remove-button.png" alt="">
                </button>
                <div><input type="text" placeholder="Улица, дом, квартира, район, домофон, этаж..."></div>
            </div>-->
<!--            <div class="form-row clearfix">
                        <span class="add-address">
                            Добавить еще один +
                        </span>
            </div>-->
            <div class="form-row control">
                <?= Html::submitButton('Сохранить изменения', ['class' => 'save']) ?>
<!--                <button class="cancel">-->
<!--                    Отмена-->
<!--                </button>-->
            </div>
            <?php ActiveForm::end(); ?>
        </div>

    </div>
</div>
