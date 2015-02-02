<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\LinkSorter;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel app\modules\video\models\VideoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = Yii::t('ru', 'Videos');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="video-index">
    <h4><i class="icon-play-circle"> </i> <?= Html::encode($this->title) ?></h4>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
//    echo ListView::widget([
//        'dataProvider' => $dataProvider,
//        'itemOptions' => ['class' => 'item'],
//        'layout' => "{sorter}\n{items}\n{pager}",
//        'itemView' => '_index_item',
//        'sorter' => [
//            'class' => LinkSorter::className(),
//            'attributes' => ['date', 'val'],
//            'options' => ['class' => 'list-inline sorter']
//        ],
//    ]);
    ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'captionOptions' => ['class' => 'gold_fund_caption'],
        'summary' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'preview',
                'format' => 'html',
                'value' => function($model) {
                    return Html::img('/statics/web/video/previews/' . $model->preview, ['class' => 'img_coaching']);
                }
                    ],
                    [
                        'attribute' => 'title',
                        'format' => 'raw',
                        'enableSorting' => false,
                        'value' => function ($model) {
//                            $is_buy = \app\modules\video\models\VideoUsr::findOne(['video_id' => $model->id, 'user_id' => \Yii::$app->user->id]);
//                            if ($is_buy != NULL || $model->_isAuthor || \Yii::$app->user->can('administrateVideo')) {
//                                $v = Html::a(
//                                                $model['title'], ['video/view', 'alias' => $model['alias']], ['class' => 'label label-success large']
//                                );
//                            } else {
//                                $v = Html::a(
//                                                $model['title'], ['video/view', 'alias' => $model['alias']]
//                                );
//                            }
                            return $this->render('_index_item', ['model' => $model]);
                        }
                            ],
                            [
                                'attribute' => 'author',
                                'enableSorting' => false,
                            ],
                            [
                                'attribute' => 'date',
                                'enableSorting' => false,
                            ],
                            [
                                'attribute' => 'val',
                                'enableSorting' => false,
                            ],
                        ],
                    ]);
                    ?>
</div>