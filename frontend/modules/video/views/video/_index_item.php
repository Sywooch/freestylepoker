<?php

use yii\helpers\Html;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div>
    <h3>
    <?= Html::a(Html::encode($model->title), ['view', 'id' => $model->id]); ?>
    </h3>
</div>
<div>
    <?= $model->description; ?>
</div>
