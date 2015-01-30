<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\video\models\LessonsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="video-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <div class="col-sm-12">
        <?= $form->field($model, 'author_id')->dropDownList($model->authors, ['prompt' => 'Выбрать...', 'onchange' => 'submit()']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
