<?php

use yii\helpers\Html;
use yii\grid\GridView;
use vova07\themes\admin\widgets\Box;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\trainings\models\TrainingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = yii::t('ru', 'Trainings');
$this->params['subtitle'] = yii::t('ru', 'Trainings Panel');
$this->params['breadcrumbs'] = [
    $this->title
];
?>
<div class="trainings-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?=
        Html::a(Yii::t('ru', 'Create {modelClass}', [
                    'modelClass' => 'Trainings',
                ]), ['create'], ['class' => 'btn btn-success'])
        ?>
    </p>

    <?php
    $gridId = 'blogs-grid';
    $gridConfig = [
        'id' => $gridId,
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                    'attribute' => 'title',
                    'format' => 'html',
                    'enableSorting' => false,
                    'value' => function ($model) {
                        $is_buy = \app\modules\trainings\models\TrainingsUsr::findOne(['training_id' => $model->id, 'user_id' => \Yii::$app->user->id]);
                        if ($is_buy != NULL || $model->_isAuthor || \Yii::$app->user->can('administrateVideo')) {
                            return Html::a(
                                            $model['title'], ['trainings/view', 'alias' => $model['alias']], ['class' => 'label label-success large']
                            );
                        } else {
                            return Html::a(
                                            $model['title'], ['trainings/view', 'alias' => $model['alias']]
                            );
                        }
                    }
                        ],
            'description:ntext',
            'val',
            // 'author_id',
            // 'alias',
            'date:date',
            // 'password',
            'type_id',
            'limit_id',
            'time_start',
            'time_end',
        ],
    ];

    ?>

    <div class="row">
        <div class="col-xs-12">
            <?php
            Box::begin(
                    [
                        'title' => $this->params['subtitle'],
                        'bodyOptions' => [
                            'class' => 'table-responsive'
                        ],
                        'grid' => $gridId
                    ]
            );
            ?>
            <?= GridView::widget($gridConfig); ?>
            <?php Box::end(); ?>
        </div>

    </div>
