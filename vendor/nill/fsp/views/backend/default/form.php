<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\select2\Widget;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model nill\fsp\models\backend\Fspstat */
/* @var $form ActiveForm */
?>
<div class="form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'user_id')->widget(Widget::className(), [
                'options' => [
                    'prompt' => \Yii::t('ru', 'Select...'),
                ],
                'settings' => [
                    'width' => '100%',
                ],
                'items' => $model->AllUsers,
            ]) ?>
        <?= $form->field($model, 'fsp') ?>
        <?= $form->field($model, 'comment') ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('ru', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- _form -->
