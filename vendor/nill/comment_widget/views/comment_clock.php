<?php
use yii\widgets\Pjax;
use yii\helpers\Html;

//Pjax::begin(['id' => 'clock']);
?>

<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#Comment_clock">
    <?= $cc_count; ?>
</button>

<!-- Modal -->
<div class="modal fade" id="Comment_clock" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Непрочитанные комментарии</h4>
            </div>
            <div class="modal-body">
                <?php
                foreach ($cc as $key => $value) {
                    $video_model = \nill\comment_widget\models\CommentsClock::getVideo($value['video_id']);                    
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
//Pjax::end();

//$this->registerJs(
//        '$("document").ready(function(){'
//        . ' setInterval(function() { '
//        . ' $.pjax.reload({container:"#clock"}) '
//        . '}, 10000)'
//        . ' });'
//);
?>