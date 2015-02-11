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
    echo \Yii::t('ru', 'Tags: ');
    $tags = explode(",", $model->tags);
    foreach ($tags as $value) {
        echo Html::a(Html::encode($value), ['', 'VideoSearch[tags]' => $value], ['class' => 'tag']) . ', ';
    }
    ?>
</div>
<div class="col-sm-2">
    <?= '<b class="icon-comment"> </b>' . $model->CommentsCount . ' '; ?>
</div>
<div class="col-sm-3">
    <?= '<b class="icon-time"> </b>' . $model->duration . \Yii::t('ru', ' min.') ?>
</div>
<?php
// Если видео куплено отображать другим цветом
if ($model->_isBuy != NULL || $model->_isAuthor) {
    $this->registerCss("tr[data-key='{$model->id}']  { background: #FAFBF8; }");
}
?>
<div class="col-sm-4 parsed" id="parsed-<?= $model->id ?>">
    <?php
    if ($model->_isBuy != NULL || $model->val == NULL) {
        if (!Yii::$app->user->isGuest) {
            if ($model->_isParsed != NULL) {
                echo '<span id="iparsed' . $model->id . '"><i class="icon-check"> </i>'
                . Html::a(
                        \Yii::t('ru', 'Parsed'), ['deleteparsed', 'id' => $model->id], ['data-pjax' => '#checked-parsed' . $model->id])
                . '</span>';
            } else {
                echo '<span id="iparsed' . $model->id . '"><i class="icon-check-empty"> </i>'
                . Html::a(
                        \Yii::t('ru', 'Parsed'), ['addparsed', 'id' => $model->id], ['data-pjax' => '#checked-parsed' . $model->id])
                . '</span>';
            }
        } else {
            echo
            \Yii::t('ru', 'You are not logged in');
        }
    } else {
        echo ' - ';
    }
    ?>
</div>
<div class="col-sm-3">
    <?= "<i>" . \Yii::t('ru', 'Rating:') . $model->rating . "</i>" ?>
</div>
<?php Pjax::begin(['id' => 'iparsed' . $model->id, 'linkSelector' => '#parsed-' . $model->id . ' a', 'enablePushState' => false]); ?>
<?php Pjax::end(); ?>