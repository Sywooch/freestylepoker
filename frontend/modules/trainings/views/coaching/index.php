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

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'user_id',
                'format' => 'html',
                'value' => function($model) {
                    $video = app\modules\video\models\Video::findOne($model->video_id);
                    return $model->user->username
                            . '<br>'
                            . $model->description
                            . '<br>'
                            . Html::a($video->title, ['/video/' . $video->alias])
                            . '<br>'
                            . Html::a('Link', $model->link)
                            . ' '
                            . Html::a('Link Forum', $model->link_forum);
                },
                    ],
                    [
                        'attribute' => 'type_id',
                        'format' => 'html',
                        'value' => function($model) {
                            return $model->type->name
                                    . ' '
                                    . $model->limit->name;
                        },
                    ],
//                    'photo',
                    'fsp',
                ],
            ]);
            ?>

</div>
