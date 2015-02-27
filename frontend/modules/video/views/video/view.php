<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\select2\Widget;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\modules\video\models\Video */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

    <div class="container-fluid">
        <div class="col-xs-12 video_view">
            <div class="video_view_header">
                <div class="video_view_header__left"><i class="icon-play"></i></div>
                <h3><?= $model->title ?></h3>
            </div>
        </div>
        <div class="col-xs-3">
            <?=
            $this->render('_rating', [
                'id' => $model->id,
                'is_rating' => $model->_isRating,
                'rating' => $model->rating,
                'val' => $model->val,
                'is_buy' => $model->_isBuy,
            ])
            ?>
            <div class="video_view__gold">
                <span class="cl"><?= \Yii::t('ru', 'Price') ?>: </span><?php echo $val = (!empty($model->val)) ? $model->val . ' &nbsp;<span class="buyed"></span> <br>' : \Yii::t('ru', 'Free video') ?>
                <br><?= $model->message ?>
                <?php
                $options = [
                    'class' => 'btn btn-primary buy',
                    'data-toggle' => 'modal',
                    'data-target' => '#myModal',
                    'title' => \Yii::t('ru', 'Buy video')
                ];

                if ($model->_isBuy == true || $model->_isAuthor || \Yii::$app->user->can('administrateVideo')) {
                    Html::addCssClass($options, 'hide');
                    echo 'Пароль: ' . $model->password;
                }

                if (Yii::$app->user->isGuest) {
                    Html::addCssClass($options, 'disabled');
                }

                if (!empty($model->val)) {
                    echo Html::button(\Yii::t('ru', 'Buy'), $options);
                }
                ?>
            </div>
            <br>
            <div class="video_view_course">
                <?php
                if ($model->ids != NULL || $model->ids != '') {
                    $course = explode(",", $model->ids);
                    echo \Yii::t('ru', 'VIDEO INCLUDED IN THE COURSE:') . ' <hr>';
                    foreach ($course as $value) {
                        $video_model = $model->getvideomodel($value);
                        echo '<i class="icon-play-circle"></i> ';
                        echo Html::a(Html::encode($video_model->title), [ 'view', 'alias' => $video_model->alias], ['class' => 'course']);
                        echo '<br><br>';
                    }
                }
                ?>
            </div>
            <?php
            if ($model->conspects) {
               echo '<br>' . \Yii::t('ru', 'OUTLINE:') . ' <hr>'
                        . '<h3 class="icon-paper-clip"></h3> <span class="consp">' . $model->conspects . '</span>';
            }
            ?>
            <div class="gift" id="gifter">
                <?php
                if (Yii::$app->user->can('administrateVideo')) {
                    echo '<br><br>'
                    . '<div class="admin_func">'
                    . \Yii::t('ru', 'Make the gift') ;
                    $gift_form = ActiveForm::begin([
                                'id' => 'gift',
                                'method' => 'post',
                                'action' => [ 'gift'],
                    ]);
                    ?>
                    <?=
                    $gift_form->field($model, 'author')->widget(Widget::className(), [
                        'options' => [
                            'prompt' => \Yii::t('ru', 'Select...'),
                        ],
                        'settings' => [
                            'width' => '100%',
                        ],
                        'items' => $model->AllUsers,
                    ])->label(false);
                    ?>
                    <?= $gift_form->field($model, 'id')->hiddenInput()->label(false); ?>
                    <?= Html::submitButton(\Yii::t('ru', 'Make the gift:'), ['class' => 'btn btn_gift'], ['id' => 'gift-sbm']) ?>
                    <?php
                    ActiveForm::end();
                    Pjax::begin(['id' => 'gifter', 'formSelector' => '#gift', 'enablePushState' => false]);
                    Pjax::end();
                    echo '</div><br>';
                }
                if (Yii::$app->user->can('administrateVideo') || $model->_isAuthor) {
                    echo Html::a(\Yii::t('ru', 'Stat'), ['stat', 'id' => $model->id], ['class' => 'stat', 'target' => '_blank']);
                }
                ?>
            </div>
        </div>
        <div class="col-xs-9">
            <iframe width="745" height="400" src="<?= $model->embed ?>" frameborder="0" allowfullscreen></iframe>
            <div class="video_view__info">
                <span class="cl"><?= \Yii::t('ru', 'Author')?>: </span><?= $model->user->username; ?>
                <b class="cl"><i class="icon-calendar"></i> </b><?= \Yii::$app->formatter->asDate($model->date); ?>
                <b class="cl"><i class="icon-time"></i> </b><?= $model->duration . \Yii::t('ru', ' min.'); ?>
                <div class="right parsed" id="parsed-<?= $model->id ?>">
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
                <?php Pjax::begin(['id' => 'iparsed' . $model->id, 'linkSelector' => '#parsed-' . $model->id . ' a', 'enablePushState' => false]); ?>
                <?php Pjax::end(); ?>
                <hr>
            </div>
            <?= $model->description ?> 
            <br>
            <br>
            <?php
            echo \Yii::t('ru', 'Tags: ');
            $tags = explode(",", $model->tags);
            foreach ($tags as $value) {
                echo Html::a(Html::encode($value), ['', 'VideoSearch[tags]' => $value], ['class' => 'tag']) . ', ';
            }
            ?>
            <?php
            if (Yii::$app->base->hasExtension('comments') && Yii::$app->user->can('viewComments') && $model->comments != 1) :
                echo '<br><br>';
                echo \vova07\comments\widgets\Comments::widget(
                        [
                            'model' => $model,
                            'jsOptions' => [ 'offset' => 80
                            ]
                        ]
                );
            endif;
            ?>                       
        </div>
    </div><!--/.col-md-8-->
</div><!--/.row-->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= \Yii::t('ru', 'Close')?></span></button>
                <h4 class="modal-title" id="myModalLabel"><?= \Yii::t('ru', 'Buy')?> "<?= $model->title ?>"</h4>
            </div>
            <div class="modal-body">
                <?= \Yii::t('ru', 'Do you really want to buy this video?')?>
            </div>
            <div class="modal-footer">
                <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'val')->hiddenInput()->label(false); ?>
                <button type="button" class="btn btn-default" data-dismiss="modal"> <?= \Yii::t('ru', 'No')?></button>
                <?= Html::submitButton(\Yii::t('ru', 'Yes, of course'), ['class' => 'btn btn-primary']) ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>