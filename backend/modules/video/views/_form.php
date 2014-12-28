<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\video\models\Video */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="video-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'embed')->textInput(['maxlength' => 256]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'val')->textInput() ?>

    <?= $form->field($model, 'author_id')->textInput() ?>

    <?= $form->field($model, 'section')->textInput() ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => 256]) ?>

    <?= $form->field($model, 'ids')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'duration')->textInput() ?>

    <?= $form->field($model, 'conspects')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'id_training')->textInput() ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => 256]) ?>

    <?= $form->field($model, 'type_id')->textInput() ?>

    <?= $form->field($model, 'limit_id')->textInput() ?>

    <?= $form->field($model, 'tags')->textInput(['maxlength' => 512]) ?>

    <?= $form->field($model, 'preview')->textInput(['maxlength' => 256]) ?>

    <?= $form->field($model, 'comments')->textInput() ?>

    <?= $form->field($model, 'gp')->textInput() ?>

    <?= $form->field($model, 'author')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
