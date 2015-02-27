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

    <h4> <?= Html::img(Yii::$app->assetManager->publish('@vova07/themes/site/assets/images/rooms.png')[1], ['class' => 'section_logo']) ?>
        <?= Html::encode($this->title) ?></h4>
    <p>
        Здесь собраны все акции покер-румов
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "{items}",
        'rowOptions' => function ($model) {
            return ['class' => 'roomspromo_row'];
        },
                'showHeader' => false,
                'tableOptions' => ['class' => 'trainings_table'],
                'columns' => [
                    [
                        'attribute' => 'img',
                        'format' => 'raw',
                        'contentOptions' => ['class' => 'roomspromo_row_img'],
                        'value' => function ($model) {
                    return Html::a(Html::img('/statics/web/rooms/previews/' . $model->img, ['style' => 'width:100px']), $model->alias . '/');
                }
                    ],
                    [
                        'attribute' => 'name',
                        'format' => 'raw',
                        'contentOptions' => ['class' => 'roomspromo_row_name'],
                    ],
                    [
                        'attribute' => 'text',
                        'format' => 'raw',
                        'contentOptions' => ['class' => 'roomspromo_row_text'],
                    ],
                ],
            ]);
            ?>

</div>
