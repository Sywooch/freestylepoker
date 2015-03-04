<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use nill\slider\Module;

/* @var $this yii\web\View */
/* @var $model app\models\Slider */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Module::t('slider', 'Slider'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Module::t('slider', 'Update Slider'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Module::t('slider', 'Delete Slider'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'h1:ntext',
            'h2:ntext',
            'h3:ntext',
            'align',
            'img',
        ],
    ]) ?>

</div>
