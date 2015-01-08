<?php

use app\modules\video\models\Video;
use yii\widgets\Pjax;
use yii\helpers\Html;

$comments_clock_model = new app\modules\video\models\CommentsClock();

$comments_clock = $comments_clock_model->find()->where(['author_id' => Yii::$app->user->id])->asArray()->all();
$comments_clock_count = $comments_clock_model->find()->where(['author_id' => Yii::$app->user->id])->count();

Pjax::begin(['id' => 'der']);
?>

<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal1">
    <?= $comments_clock_count; ?>
</button>

<!-- Modal -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                <?php
                foreach ($comments_clock as $key => $value) {
                    $video_model = Video::findOne(['id' => $value['video_id']]);
                    echo Html::a(Html::encode($video_model->title), ['view', 'alias' => $video_model->alias], ['data-pjax'=>'0']);
                    echo '<br>';
                }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<?php
Pjax::end();

$this->registerJs(
        '$("document").ready(function(){'
        . ' setInterval(function() { '
        . ' $.pjax.reload({container:"#der"}) '
        . '}, 10000)'
        . ' });'
);
?>