<?php

use yii\helpers\Html;
use himiklab\sortablegrid\SortableGridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\rooms\models\RoomsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('ru', 'Rooms');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rooms-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('ru', 'Create {modelClass}', [
    'modelClass' => 'Rooms',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= SortableGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'net',
            'alias',
            'snippet:ntext',
            'sortOrder',
            // 'promo',
            // 'logo',
            // 'content:ntext',
            // 'info:ntext',
            // 'instruction:ntext',
            // 'bonus',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
