<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\fileapi\Widget as FileAPI;
use nill\slider\Module;

/* @var $this yii\web\View */
/* @var $model app\models\Slider */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="slider-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'h1')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'h2')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'h3')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'align')->dropDownList($align) ?>

    <?= $form->field($model, 'img')->widget(
    FileAPI::className(),
    [
        'settings' => [
            'url' => ['/slider/default/fileapi-upload']
        ]
    ]
) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Module::t('slider', 'Create Slider') : Module::t('slider', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
