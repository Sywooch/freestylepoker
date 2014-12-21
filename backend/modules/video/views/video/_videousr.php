<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\video\models\VideoUsr */
/* @var $form ActiveForm */
?>
<div class="videousr">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'video_id') ?>
        <?= $form->field($model, 'user_id') ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('ru', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- _videousr -->
