<?php

use yii\helpers\Html;
use yii\grid\GridView;
use nill\slider\Module;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SliderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('slider', 'Slider');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Module::t('slider', 'Create Slider'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'h1:ntext',
            'h2:ntext',
            'h3:ntext',
            'align',
            // 'img',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
