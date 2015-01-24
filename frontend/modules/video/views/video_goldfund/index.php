<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\video\models\Video_goldfundSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('ru', 'Video Goldfunds');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-goldfund-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    echo $this->render('_search', ['model' => $searchModel]);

    $video_type_count = $searchModel->VideoTypeCount;

    for ($i = 1; $i <= $video_type_count; $i++) {
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $i);
        $title_table = \app\modules\video\models\VideoType::findOne(['id' => $i])->getAttribute('name');

        // Выводим процент доступности
        echo $searchModel->search(Yii::$app->request->queryParams, $i, true);

        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'caption' => $title_table,
            'captionOptions' => ['class' => 'gold_fund_caption'],
            'summary' => false,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'limit_id',
                    'format' => 'html',
                    //'value' => 'limit.name',
                    'enableSorting' => false,
                    'value' => function ($model) {
                        static $a;
                        if ($a != $model->limit['name']) {
                            $a = $model->limit['name'];
                            return $model->limit['name'];
                        } else {
                            return '';
                        }
                    }
                ],
                [
                    'attribute' => 'title',
                    'format' => 'html',
                    'enableSorting' => false,
                    'value' => function ($model) {
                        $is_buy = \app\modules\video\models\VideoUsr::findOne(['video_id' => $model->id, 'user_id' => \Yii::$app->user->id]);
                        if ($is_buy != NULL || $model->_isAuthor || \Yii::$app->user->can('administrateVideo')) {
                            return Html::a(
                                            $model['title'], ['video/view', 'alias' => $model['alias']], ['class' => 'label label-success large']
                            );
                        } else {
                            return Html::a(
                                            $model['title'], ['video/view', 'alias' => $model['alias']]
                            );
                        }
                    }
                        ],
                        [
                            'attribute' => 'val',
                            'enableSorting' => false,
                        ],
                        [
                            'attribute' => 'author',
                            'enableSorting' => false,
                        ],
                        [
                            'attribute' => 'videoparsed.id',
                            'format' => 'html',
                            'value' => function ($model) {
                                if ($model->videoparsed['user_id'] === Yii::$app->user->id && $model->videoparsed != NULL) {
                                    return 'Parsed';
                                }
                            }
                        ]
                    ],
                ]);
                ?>
                <div>sss</div>
                <?php
            }
            ?>

</div>
