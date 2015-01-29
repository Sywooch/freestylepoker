<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\rooms\models\Rakeback */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rakeback-form">
    <div class="col-sm-12">
        Во всех покер румах, с каждого разыгрываемого банка взимается комиссия - рэйк. 
        Так за месяц игры может набежать солидная сумма. 
        Часть рейка мы возвращаем, эта часть называется рэйкбек.
        <br>
        <br>
    </div>
    <div class="col-sm-4">

        <h4>Как это работает?</h4>

        Мы максимально упрощаем способ 
        получения рэйкбека, 
        всё происходит в 3 шага:<br><br>
        <ul class="faq unstyled">
            <li><span class="number number_red">1</span>
                <div>
                    Вы заполняете и 
                    отправляете форму справа
                    (проверьте правильность данных)
                </div>
            </li>
            <li><span class="number number_red">2</span>
                <div>
                    Наш оператор просматривает
                    заявку и звонит, предлагая
                    подходящие вам условия 
                </div>
            </li>
            <li><span class="number number_red">3</span>
                <div>
                    Вы регистрируетесь в руме
                    и играете по лучшим условиям
                </div>
            </li>
        </ul>

    </div>
    <div class="col-sm-4 xbs">
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'name')->textInput(['maxlength' => 32]) ?>
        <?= $form->field($model, 'phone')->textInput() ?>
        <?= $form->field($model, 'skype')->textInput(['maxlength' => 32]) ?>
        <?= $form->field($model, 'email')->textInput(['maxlength' => 32]) ?>
        <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
    </div>
    <div class="col-sm-4">

        <?= $form->field($model, 'type_poker')->textInput() ?>

        <?= $form->field($model, 'link')->textInput(['maxlength' => 32]) ?>

        <?php // $form->field($model, 'about')->textarea(['rows' => 6]) ?>
        <?=
        $form->field($model, 'about')->radioList([
            'Увидел ВОД на Youtube' => 'Увидел ВОД на Youtube',
            'Нашел в поисковике' => 'Нашел в поисковике',
            'Посоветовал друг' => 'Посоветовал друг',
            '3' => 'Другое',
                ], ['separator' => '<br>'])
        ?>

        <?=
        $form->field($model, 'about')->textInput([
            'maxlength' => 32,
            'style' => 'display:none',
            'class' => 'about',
            'name' => false,
        ])->label(false)
        ?>

        <?= $form->field($model, 'fsp')->radioList(['1' => 'Да', '0' => 'Нет']) ?>

        <?= $form->field($model, 'rooms')->radioList(['1' => 'Да', '0' => 'Нет']) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('ru', 'Send') : Yii::t('ru', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<style>
    .xbs {
        border-style: solid;
        border-width: 1px;
        border-color: rgb(218, 225, 232);
        background-color: rgb(231, 231, 231);
    }
    .rb_q {
        float: left;
    }
</style>
<script src="/assets/2ae059fd/jquery.js"></script>
<script>
    $(document).ready(function () {
        $('input[name="Rakeback[about]"][value="3"]').on('change', function () {
            $('.about').attr({'name': 'Rakeback[about]'});
            $('.about').show();
        })
    })
</script>