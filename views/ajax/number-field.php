<div class="form-row clearfix new-number active">
    <?php
    echo \yii\widgets\MaskedInput::widget([
        'name' => 'phones[]',
        'mask' => '+380999999999',
        'options'=>[
            'class' => 'add-phone'
        ],
        'clientOptions'=>[
            'clearIncomplete' => true
        ]
    ]);
    ?>
    <a href="javascript:void(0)" class="remove-number-block">
        <img src="/img/remove-button.png" alt="">
    </a>
</div>
<script>
    $(".add-phone").inputmask(<?= $maskedValidator?>);
</script>