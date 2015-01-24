<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\rooms\models\RoomsPromoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('ru', 'Rooms Promos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rooms-promo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('ru', 'Create {modelClass}', [
    'modelClass' => 'Rooms Promo',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'text:ntext',
            'alias',
            'img',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
