<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\video\models\Video_goldfundSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="video-goldfund-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <div class="col-sm-3">
        <?= $form->field($model, 'is_buy')->checkbox(['onclick' => 'submit()']) ?>
    </div>
    <div class="col-sm-9">
        <?= $form->field($model, 'is_parsed')->checkbox(['onclick' => 'submit()']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
