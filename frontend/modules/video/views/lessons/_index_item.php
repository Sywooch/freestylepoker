<?php

use yii\helpers\Html;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="col-sm-2 box box-succes">
    <div class="lesson">
        <?= Html::a(Html::encode($model->title), ['view', 'alias' => $model->alias]); ?>
    </div>
    <div class="center">
        <?= Html::img('/statics/web/video/previews/' . $model->preview, ['style' => 'padding:0px; width:100%']) ?>
    </div>
    <div class="lesson">
        <?= '<b>Автор: </b>' . $model->author ?>
        <?= '<br>' ?>
        <?= '<b>Дата: </b>' . \Yii::$app->formatter->asDate($model->date) ?>
    </div>
</div>