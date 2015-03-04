<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget as Imperavi;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\rooms\models\Statical */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="statical-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'text')->widget(
                Imperavi::className(), [
            'settings' => [
                'minHeight' => 70,
                'imageGetJson' => Url::to(['/statical/default/imperavi-get']),
                'imageUpload' => Url::to(['/statical/default/imperavi-image-upload']),
                'fileUpload' => Url::to(['/statical/default/imperavi-file-upload'])
            ]
                ]
        ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
