<?php

use yii\helpers\Html;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="room_list__box">
    <div class="center room_list__logo">
        <?= Html::img('/statics/web/rooms/previews/' . $model->logo, ['style' => 'padding:0px']) ?>
    </div>
    <div class="room_list__title">
        <?= Html::a(Html::encode($model->title), ['view', 'alias' => $model->alias]); ?>
        <span class="right room_list__net">
            <small>
                <?= \Yii::t('ru', 'Network:') ?> 
            </small>
            <?= Html::tag('span', Html::encode($model->net), ['class' => 'net']); ?>
        </span>
    </div>
    <div class="room_list__bonus">
        <span class="room_list__bonus__span">
            <?= Html::encode($model->bonus); ?>
        </span>
        <span class="right room_list__reg">
            <?php
            if (!$model->isAccount && !\Yii::$app->user->isGuest) {
                echo Html::a(Html::encode('Регистрация'), ['view', 'alias' => $model->alias, '#' => 'accounts']);
            } elseif (\Yii::$app->user->isGuest) {
                echo 'Вы не авторизированы';
            } elseif ($model->isAccount && $model->Account_status) {
                echo '<i class="icon-ok" style="color:#7eaf15"></i> ' . $model->Account_status;
            } else {
                echo 'Аккаунт ожидает подтветржения';
            }
            ?>
        </span>
    </div>
    <div class="room_list__info">
        <?= $model->info; ?>
    </div>

</div>