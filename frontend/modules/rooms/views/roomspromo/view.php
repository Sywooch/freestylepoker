<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\rooms\models\RoomsPromo */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('ru', 'Rooms Promos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rooms-promo-view">

    <div class="box box-success row">
        <div class="col-sm-12">
            <?= Html::img('/statics/web/rooms/previews/' . $model->img, ['style' => 'padding:0 10px 10px; width: 200px; float:left']) ?>
            <h4>
                <?= Html::encode($this->title) ?>
            </h4>
            <?= Html::encode($model->text); ?>
        </div>
        
    </div>
</div>

    
    
    
    <?php
//        DetailView::widget([
//        'model' => $model,
//        'attributes' => [
//            'id',
//            'name',
//            'text:ntext',
//            'alias',
//            'img',
//        ],
//    ]) 
        ?>

