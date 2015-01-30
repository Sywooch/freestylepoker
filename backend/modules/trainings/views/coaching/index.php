<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\trainings\models\CoachingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('ru', 'Coachings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coaching-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('ru', 'Create {modelClass}', [
    'modelClass' => 'Coaching',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'photo',
            'description:ntext',
            'fsp',
            // 'type_id',
            // 'limit_id',
            // 'video_id',
            // 'link',
            // 'link_forum',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
