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
            <?= $form->field($model, 'val1') ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'val2') ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'author')->dropDownList($model->authors) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'cup')->checkbox(['onclick' => 'submit()']) ?>
        </div>
        <div class="col-sm-9">
            <?= $form->field($model, 'ons')->checkbox(['onclick' => 'submit()']) ?>
        </div>

        <div class="form-group col-sm-9">
            <?= Html::submitButton(\Yii::t('ru', 'Search'), ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton(\Yii::t('ru', 'Reset'), ['class' => 'btn btn-danger']) ?>
            <?= Html::a(\Yii::t('ru', 'Back'), "/{$dir}/", ['class' => 'btn btn-info']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
