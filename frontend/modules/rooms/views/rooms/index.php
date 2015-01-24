<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\rooms\models\RoomsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('ru', 'Rooms');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rooms-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    echo ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item-room'],
        'layout' => "{items}\n{pager}",
        'itemView' => '_index_item',
    ]);
    ?>

</div>
