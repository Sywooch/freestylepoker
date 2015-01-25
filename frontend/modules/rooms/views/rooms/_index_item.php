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
            <?php
            if (!$model->isAccount && !\Yii::$app->user->isGuest) {
                echo Html::a(Html::encode('Регистрация в руме'), ['view', 'alias' => $model->alias, '#' => 'accounts']);
            } 
            elseif (\Yii::$app->user->isGuest) {
                echo 'Вы не авторизированы';
            }
            elseif($model->isAccount && $model->Account_status) {
                echo 'Ник в руме: <b>'. $model->Account_status . '</b>';
            }
            else {
                echo 'Аккаунт ожидает подтветржения';
            }
            ?>
        </span>
    </div>
    <div class="room_list__info">
    <?= $model->info; ?>
    </div>

</div>