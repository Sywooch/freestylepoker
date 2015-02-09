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
        'headerRowOptions' => ['class' => 'video_header'],
        'layout' => "{summary}{pager}<br>{items}{pager}",
        'rowOptions' => function ($model) {
    if ($model->_isBuy) {
        return ['class' => 'video_column__buyed'];
    }
},
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
            [
                //'attribute' => 'preview',
                'contentOptions' => ['class' => 'video_preview__column'],
                'label' => 'Видео',
                'format' => 'html',
                'value' => function($model) {
            return Html::img('/statics/web/video/previews/' . $model->preview, ['class' => 'video_preview']);
        },
            ],
            [
                'label' => 'Описание',
                'contentOptions' => ['class' => 'video_content'],
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
                'label' => 'Автор',
                'contentOptions' => ['class' => 'video_author'],
                'attribute' => 'user.username',
                'enableSorting' => false,
            ],
            [
                'attribute' => 'date',
                'contentOptions' => ['class' => 'video_date'],
                'enableSorting' => false,
                'value' => function($model) {
            return \Yii::$app->formatter->asDate($model->date);
        }
            ],
            [
                'label' => 'Цена',
                'attribute' => 'val',
                'contentOptions' => ['class' => 'video_fsp'],
                'format' => 'raw',
                'enableSorting' => false,
                'value' => function($model) {
            if ($model->val == NULL) {
                return '<span class="not_buyed">Бесплатно</span>';
            } else {
                if ($model->_isBuy) {
                    return '<i class="icon-ok"> </i>Куплено';
                } else {
                    return '<span class="fsp">' . $model->val . '</span>&nbsp;<span class="buyed"></span>';
                }
            }
        }
            ],
        ],
    ]);
    ?>
</div>