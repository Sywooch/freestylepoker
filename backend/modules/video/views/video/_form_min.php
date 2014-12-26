<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\video\models\Video */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$form = ActiveForm::begin([
            'enableAjaxValidation' => true]);
?>

<?= $form->field($model, 'section')->hiddenInput(['value' => 0])->label(false) ?>

<div class="col-sm-6">
    <?= $form->field($model, 'title') ?>
</div>
<div class="col-sm-6">
    <?= $form->field($model, 'author') ?>
</div>
<div class="col-sm-6">
    <?= $form->field($model, 'description')->textarea(['style' => 'height:108px']) ?>
</div>
<div class="col-sm-6">
    <?= $form->field($model, 'embed') ?>
</div>
<div class="col-sm-6">
    <?= $form->field($model, 'alias') ?>
</div>
<div class="col-sm-6">
    <?= $form->field($model, 'ids') ?>
</div>
<div class="col-sm-6">
    <?=
    $form->field($model, 'date')->widget(
            DatePicker::className(), [
        'options' => [
            'class' => 'form-control'
        ],
        'clientOptions' => [
            'dateFormat' => 'dd.mm.yy',
            'changeMonth' => true,
            'changeYear' => true
        ]
            ]
    );
    ?>
</div>
<div class="col-sm-6">
    <?= $form->field($model, 'duration') ?>
</div>
<div class="col-sm-6">
    <?= $form->field($model, 'conspects') ?>
</div>
<div class="col-sm-6">
    <?= $form->field($model, 'id_training') ?>
</div>
<div class="col-sm-6">
    <?= $form->field($model, 'password') ?>
</div>
<div class="col-sm-6">
    <?= $form->field($model, 'tags') ?>
</div>
<div class="col-sm-6">
    <?= $form->field($model, 'preview') ?>
</div>

<div class="col-sm-6">
    <?= $form->field($model, 'val') ?>
</div>
<div class="col-sm-6">
    <?= $form->field($model, 'type_id')->dropDownList($model->typer, ['id' => 'cat-id', 'placeholder' => 'Select...']); ?>
</div>
<div class="col-sm-6">
    <?=
    $form->field($model, 'limit_id')->widget(DepDrop::classname(), [
        'options' => ['id' => 'subcat-id'],
        'data' => $model->getData($model->type_id),
        'pluginOptions' => [
            'depends' => ['cat-id'],
            'placeholder' => 'Select...',
            'url' => Url::to(['video/subcat/'])
        ]
    ]);
    ?>
</div>

<div class="col-sm-6">
    <?= $form->field($model, 'comments')->checkbox() ?>
</div>
<div class="col-sm-6">
    <?= $form->field($model, 'gp')->checkbox() ?>
</div>

<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>


