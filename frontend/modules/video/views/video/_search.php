<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$dir = \Yii::$app->controller->id;

/* @var $this yii\web\View */
/* @var $model app\modules\video\models\VideoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="video-search">
    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>
    <div class="video-filter">
        <div class="video_filter__title">
            <div class="col-sm-8">
                Фильтры
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'title')->textInput(['placeholder' => 'Поиск'])->label(false) ?>
            </div>
        </div>
        <br>
        <hr>
        <div class="col-sm-4">
            <?= $form->field($model, 'author_id')->dropDownList($model->authors, ['prompt' => 'Автор...', 'onchange' => 'submit()'])->label(false) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'is_buy')->checkbox(['onclick' => 'submit()']) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'is_parsed')->checkbox(['onclick' => 'submit()']) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'from_val')->textInput(['placeholder' => 'Цена от'])->label(false) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'to_val')->textInput(['placeholder' => 'Цена до'])->label(false) ?>
        </div>

        <br>

        <div class="col-sm-4">
            <?= $form->field($model, 'type_id')->dropDownList($model->authors, ['prompt' => 'Тип...', 'onchange' => 'submit()'])->label(false) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'is_buy')->checkbox(['onclick' => 'submit()']) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'is_parsed')->checkbox(['onclick' => 'submit()']) ?>
        </div>
        <div class="col-sm-4 text-right page_size">
                <?php
                echo 'Видео на странице: ' .
                Html::a('1', '?page_size=1');
                echo ' ' .
                Html::a('2', '?page_size=2');
                echo ' ' .
                Html::a('3', '?page_size=3');
                ?>
        </div>
    <br>

    <div class="col-sm-2">
        <?= $form->field($model, 'limit_id')->textInput(['placeholder' => 'Лимиты от'])->label(false) ?>
    </div>
    <div class="col-sm-2">
        <?= $form->field($model, 'limit_id')->textInput(['placeholder' => 'Лимиты до'])->label(false) ?>
    </div>
    <div class="col-sm-2">
        <?= $form->field($model, 'is_buy')->checkbox(['onclick' => 'submit()']) ?>
    </div>
    <div class="form-group text-right col-sm-6">
        <?= Html::submitButton(\Yii::t('ru', 'Search'), ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::resetButton(\Yii::t('ru', 'Reset'), ['class' => 'btn btn-danger btn-sm']) ?>
        <?= Html::a(\Yii::t('ru', 'Back'), "/{$dir}/", ['class' => 'btn btn-info btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>  
</div>
</div>