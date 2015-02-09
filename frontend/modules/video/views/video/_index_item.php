<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="col-sm-12">
    <p>
        <?= Html::a(Html::encode($model->title), ['view', 'alias' => $model->alias]); ?>
    </p>
</div>
<div class="col-sm-12">
    <?= $model->description; ?>
</div>
<div class="col-sm-12">
    <?php
    echo 'Теги: ';
    $tags = explode(",", $model->tags);
    foreach ($tags as $value) {
        echo '<a class="tag" href="?VideoSearch[tags]=' . $value . '">' . $value . '</a>, ';
    }
    ?>
</div>
<div class="col-sm-2">
    <?= '<b class="icon-comment"> </b>' . $model->CommentsCount . ' '; ?>
</div>
<div class="col-sm-3">
    <?= '<b class="icon-time"> </b>' . $model->duration . ' мин.' ?>
</div>
<?php
// Если видео куплено отображать другим цветом
if ($model->_isBuy != NULL || $model->_isAuthor || \Yii::$app->user->can('administrateVideo')) {
    $this->registerCss("div.item[data-key='{$model->id}']  { background: #00FFAE; }");
}
?>
<div class="col-sm-4 parsed" id="parsed-<?= $model->id ?>">
    <?php
    if ($model->_isBuy != NULL || $model->val == NULL) {
        if (!Yii::$app->user->isGuest) {
            if ($model->_isParsed != NULL) {
                echo '<span id="iparsed' . $model->id . '"><i class="icon-check"> </i>'
                . Html::a(
                        'Разобранное', ['deleteparsed', 'id' => $model->id], ['data-pjax' => '#checked-parsed' . $model->id])
                . '</span>';
            } else {
                echo '<span id="iparsed' . $model->id . '"><i class="icon-check-empty"> </i>'
                . Html::a(
                        'Разобранное', ['addparsed', 'id' => $model->id], ['data-pjax' => '#checked-parsed' . $model->id])
                . '</span>';
            }
        } else {
            echo
            'Вы не зарегестрированы';
        }
    } else {
        echo ' - ';
    }
    ?>
</div>
<div class="col-sm-3">
    <?= '<i>Рейтинг: </i>' . $model->rating ?>
</div>
<?php Pjax::begin(['id' => 'iparsed' . $model->id, 'linkSelector' => '#parsed-' . $model->id . ' a', 'enablePushState' => false]); ?>
<?php Pjax::end(); ?>