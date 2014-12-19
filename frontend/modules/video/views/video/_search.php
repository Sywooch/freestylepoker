<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$dir=\Yii::$app->controller->id;

/* @var $this yii\web\View */
/* @var $model app\modules\video\models\VideoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="video-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'description') ?>

    <div class="form-group">
        <?= Html::submitButton(\Yii::t('ru','Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(\Yii::t('ru','Reset'), ['class' => 'btn btn-danger']) ?>
        <?= Html::a(\Yii::t('ru','Back'), "/{$dir}/" ,['class' => 'btn btn-info']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
