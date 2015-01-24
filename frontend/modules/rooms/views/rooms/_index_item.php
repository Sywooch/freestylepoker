<?php

use yii\helpers\Html;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="col-sm-4 box box-success">
    <div class="center">
        <?= Html::img('/statics/web/rooms/previews/' . $model->logo, ['style' => 'padding:0px']) ?>
    </div>
    <div class="room_list__title">
        <h4>
            <?= Html::a(Html::encode($model->title), ['view', 'alias' => $model->alias]); ?>
        <span class="right">
            <?= Html::encode($model->net); ?>
        </span>
        </h4>
    </div>
    <div class="room_list__bonus">
        <span class="room_list__bonus__span">
            <?= Html::encode($model->bonus); ?>
        </span>
        <span class="right">
            <?= Html::a(Html::encode('Registration'), ['view', 'alias' => $model->alias]);  ?>
        </span>
    </div>
    <div class="room_list__info">
    <?= $model->info; ?>
    </div>

</div>