<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\rooms\models\RoomsPromoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('ru', 'Rooms Promos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rooms-promo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'img',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::a(Html::img('/statics/web/rooms/previews/'.$model->img, ['style'=>'width:100px']), $model->alias.'/');
                }
            ],
            'name',
            'text:ntext',
        ],
    ]);
    ?>

</div>
