<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use vova07\fileapi\Widget as FileAPI;
use vova07\select2\Widget;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\modules\video\models\Video */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$form = ActiveForm::begin([
            'enableAjaxValidation' => true
        ]);
?>

<div class="col-sm-12">
    <?= $form->field($model, 'section')->checkbox() ?>
</div>
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
<div class="col-sm-3">
    <?= $form->field($model, 'duration') ?>
</div>
<div class="col-sm-3">
    <?= $form->field($model, 'conspects') ?>
</div>
<div class="col-sm-6">
    <?=
    $form->field($model, 'tags')->widget(Select2::classname(), [
        'options' => ['placeholder' => 'Select a state ...'],
        'pluginOptions' => [
            'tags' => $model->Tags,
            'maximumInputLength' => 10
        ],
    ]);
    ?>
</div>
<div class="col-sm-3">
    <?= $form->field($model, 'password') ?>
</div>
<div class="col-sm-3">
    <?= $form->field($model, 'id_training') ?>
</div>
<div class="col-sm-6">
    <?= $form->field($model, 'val') ?>
</div>
<div class="col-sm-3">
    <?= $form->field($model, 'type_id')->dropDownList($model->typer, ['id' => 'type_id', 'prompt' => Yii::t('ru', 'Select...')]); ?>
</div>
<div class="col-sm-3">
    <?php
    echo $form->field($model, 'limit_id')->widget(DepDrop::classname(), [
        'options' => ['id' => 'limit_id'],
        'data' => $model->getCurrentLimits($model->type_id),
        'pluginOptions' => [
            'depends' => ['type_id'],
            'placeholder' => Yii::t('ru', 'Select...'),
            'url' => Url::to(['video/getlimits/']),
            'loadingText' => 'Загрузка ...'
        ]
    ]);
    ?>
</div>
<div class="col-sm-6">
    <?= $form->field($model, 'ids'); ?>
</div>
<div class="col-sm-6">
    <?= $form->field($model, 'comments')->checkbox() ?>
</div>
<div class="col-sm-6">
    <?= $form->field($model, 'gp')->checkbox() ?>
</div>
<div class="col-sm-12">
    <?=
    $form->field($model, 'preview')->widget(
            FileAPI::className(), [
        'settings' => [
            'url' => ['/video/video/fileapi-upload']
        ]
            ]
    )
    ?>
</div>
<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('ru', 'Create') : Yii::t('ru', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>