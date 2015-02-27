<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\rooms\models\Rakeback */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rakeback-form">
    <div class="col-sm-4">
        <div class="vertical-line right"></div>
        <span class="rb_left_title">Как это работает?</span>
        <br><br>
        Мы максимально упрощаем способ 
        получения рэйкбека, 
        всё происходит в 3 шага:
        <br><br>
        <ul class="faq unstyled">
            <li><span class="rb_number">1.</span>
                <div>
                    Вы заполняете и 
                    отправляете форму справа
                    (проверьте правильность данных)
                </div>
            </li>
            <li><span class="rb_number">2.</span>
                <div>
                    Наш оператор просматривает
                    заявку и звонит, предлагая
                    подходящие вам условия 
                </div>
            </li>
            <li><span class="rb_number">3.</span>
                <div>
                    Вы регистрируетесь в руме
                    и играете по лучшим условиям
                </div>
            </li>
        </ul>
        <br><br>
        <?= Html::img(Yii::$app->assetManager->publish('@vova07/themes/site/assets/images/rakeback_1.png')[1], ['class' => 'rb_imgs']) ?>
        <?= Html::img(Yii::$app->assetManager->publish('@vova07/themes/site/assets/images/arr.png')[1], ['class' => 'rb_imgs']) ?>
        <?= Html::img(Yii::$app->assetManager->publish('@vova07/themes/site/assets/images/rakeback_2.png')[1], ['class' => 'rb_imgs']) ?>
        <?= Html::img(Yii::$app->assetManager->publish('@vova07/themes/site/assets/images/arr.png')[1], ['class' => 'rb_imgs']) ?>
        <?= Html::img(Yii::$app->assetManager->publish('@vova07/themes/site/assets/images/rakeback_3.png')[1], ['class' => 'rb_imgs']) ?>
    </div>
    <div class="col-sm-4">
        <div class="rb_require col-sm-12">
            <span class="rb_require_title">Контакты для связи</span>
            <p>- обязательные поля</p>
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'name')->textInput(['maxlength' => 32, 'placeholder' => \Yii::t('ru', 'Name')])->label(false) ?>
            <?= $form->field($model, 'email')->textInput(['maxlength' => 32, 'placeholder' => \Yii::t('ru', 'Email')])->label(false) ?>
            <span class="rb_require_ts">Если вы ввели логин skype, то телефон писать не обязательно, и наоборот.</span>
            <?= $form->field($model, 'skype')->textInput(['maxlength' => 32, 'placeholder' => \Yii::t('ru', 'Skype')])->label(false) ?>
            <?= $form->field($model, 'phone')->textInput(['placeholder' => \Yii::t('ru', 'Phone')])->label(false) ?>
        </div>
        <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('ru', 'Send') : Yii::t('ru', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
    <div class="col-sm-4">
        <span class="rb_3_title">Дополнительная информация поможет подобрать лучшие условия для вас</span>
        <br><br>
        <?= $form->field($model, 'type_poker')->textInput(['placeholder' => \Yii::t('ru', 'Type Poker')])->label(false) ?>
        <span class="rb_3_prof">Ваш профиль на других покерных ресурсах</span>
        <?= $form->field($model, 'link')->textInput(['maxlength' => 32, 'placeholder' => \Yii::t('ru', 'Link')])->label(false) ?>

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
            'class' => 'about form-control',
            'name' => false,
        ])->label(false)
        ?>
        <hr>
        <?= $form->field($model, 'fsp')->radioList(['1' => 'Да', '0' => 'Нет']) ?>
        <?= $form->field($model, 'rooms')->radioList(['1' => 'Да', '0' => 'Нет']) ?>
        <hr>
    </div>



    <?php ActiveForm::end(); ?>

</div>
<style>
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