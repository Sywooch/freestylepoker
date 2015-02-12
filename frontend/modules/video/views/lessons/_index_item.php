<?php

use yii\helpers\Html;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="col-sm-4 lesson">
    <div class="lesson_title">
        <?= Html::a(Html::encode($model->title), ['view', 'alias' => $model->alias]); ?>
    </div>
    <div class="center">
        <?= Html::img('/statics/web/video/previews/' . $model->preview, ['style' => 'padding:0px; width:257px']) ?>
    </div>
    <div class="lesson_footer">
        <small><i class="icon-calendar"></i> <?= \Yii::$app->formatter->asDate($model->date); ?></small>
         <span class="lesson_author"><?= \Yii::t('ru', 'Author')?>: <?= $model->user->username; ?></span>
        <?= '<br>' ?>
    </div>
</div>