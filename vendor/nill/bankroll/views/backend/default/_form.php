<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\fileapi\Widget as FileAPI;

/* @var $this yii\web\View */
/* @var $model app\modules\rooms\models\Bankroll */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bankroll-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
    $form->field($model, 'img')->widget(
            FileAPI::className(), [
        'settings' => [
            'url' => ['/bankroll/default/fileapi-upload']
        ]
            ]
    )
    ?>

    <?= $form->field($model, 'text')->textInput() ?>

    <?= $form->field($model, 'lot')->textInput() ?>

    <?= $form->field($model, 'link')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
