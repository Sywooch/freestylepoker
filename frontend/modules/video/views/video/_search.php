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
    <div class="row">
        <br>
        <div class="col-sm-12">
            <?= $form->field($model, 'title') ?>
        </div>
        <div class="col-sm-12">
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'from_val') ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'to_val') ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'author_id')->dropDownList($model->authors, ['prompt' => 'Выбрать...', 'onchange' => 'submit()']) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'is_buy')->checkbox(['onclick' => 'submit()']) ?>
        </div>
        <div class="col-sm-9">
            <?= $form->field($model, 'is_parsed')->checkbox(['onclick' => 'submit()']) ?>
        </div>

        <div class="form-group col-sm-9">
            <?= Html::submitButton(\Yii::t('ru', 'Search'), ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton(\Yii::t('ru', 'Reset'), ['class' => 'btn btn-danger']) ?>
            <?= Html::a(\Yii::t('ru', 'Back'), "/{$dir}/", ['class' => 'btn btn-info']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
    <div class="col-sm-12 text-right page_size">
        <?php
        echo 'Видео на странице: ' .
        Html::a('1', '?page_size=1');
        echo ' ' .
        Html::a('2', '?page_size=2');
        echo ' ' .
        Html::a('3', '?page_size=3');
        ?>
        <br><br>
    </div>

</div>