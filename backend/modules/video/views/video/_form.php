<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use vova07\fileapi\Widget as FileAPI;
use vova07\select2\Widget;
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
    <?= $form->field($model, 'tags')
//            ->widget(Widget::className(), [
//                'options' => [
//                    'multiple' => true,
//                    'placeholder' => Yii::t('ru','Select tags...'),
//                ],
//                'settings' => [
//                    'width' => '100%',
//                ],
//                'items' => $model->Tags
//            ])->label('tags') ?>
    
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
    <?= $form->field($model, 'type_id')->dropDownList($model->typer, ['id' => 'type_id', 'prompt' => 'Выбрать']); ?>
</div>
<div class="col-sm-3">
    <?php 
    echo $form->field($model, 'limit_id')->widget(DepDrop::classname(), [
        'options' => ['id' => 'limit_id'],
        'data' => $model->getCurrentLimits($model->type_id),
        'pluginOptions' => [
            'depends' => ['type_id'],
            'placeholder' => 'Выбрать...',
            'url' => Url::to(['video/getlimits/']),
            'loadingText' => 'Загрузка ...'
        ]
    ]);
    ?>
</div>
<div class="col-sm-6">
    <?= $form->field($model, 'ids') ?>
</div>
<div class="col-sm-6">
    <?= $form->field($model, 'comments')->checkbox() ?>
</div>
<div class="col-sm-6">
    <?= $form->field($model, 'gp')->checkbox() ?>
</div>
<div class="col-sm-12">
     <?= $form->field($model, 'preview')->widget(
                FileAPI::className(),
                [
                    'settings' => [
                        'url' => ['/video/video/fileapi-upload']
                    ]
                ]
            ) ?>
</div>
<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('ru', 'Create') : Yii::t('ru', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>