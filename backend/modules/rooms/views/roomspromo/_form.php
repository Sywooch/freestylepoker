<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\fileapi\Widget as FileAPI;

/* @var $this yii\web\View */
/* @var $model app\modules\rooms\models\RoomsPromo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rooms-promo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => 100]) ?>

    <?=
    $form->field($model, 'img')->widget(
            FileAPI::className(), [
        'crop' => true,
        'cropResizeWidth' => 200,
        'cropResizeHeight' => 200,
        'settings' => [
            'url' => ['/rooms/roomspromo/fileapi-upload'],
        ]
            ]
    )
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('ru', 'Create') : Yii::t('ru', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
