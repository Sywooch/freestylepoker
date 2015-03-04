<?php

use yii\helpers\Html;
use nill\slider\Module;


/* @var $this yii\web\View */
/* @var $model app\models\Slider */

$this->title = Module::t('slider', 'Create Slider');
$this->params['breadcrumbs'][] = ['label' => Module::t('slider', 'Slider'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'align' => $align,
    ]) ?>

</div>
