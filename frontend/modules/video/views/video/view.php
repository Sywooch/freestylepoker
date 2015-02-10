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
                <span class="cl">Цена: </span><?php echo $val = (!empty($model->val)) ? $model->val . ' &nbsp;<span class="buyed"></span> <br>' : 'Бесплатно' ?>
                <br><?= $model->message ?>
                <?php
                $options = [
                    'class' => 'btn btn-primary buy',
                    'data-toggle' => 'modal',
                    'data-target' => '#myModal',
                    'title' => 'Купить доступ к просмотру'
                ];

                if ($model->_isBuy == true || $model->_isAuthor || \Yii::$app->user->can('administrateVideo')) {
                    Html::addCssClass($options, 'hide');
                    echo 'Пароль: ' . $model->password;
                }

                if (Yii::$app->user->isGuest) {
                    Html::addCssClass($options, 'disabled');
                }

                if (!empty($model->val)) {
                    echo Html::button('Купить', $options);
                }
                ?>
            </div>
            <br>
            <div class="video_view_course">
                <?php
                if ($model->ids != NULL || $model->ids != '') {
                    $course = explode(",", $model->ids);
                    echo 'ВИДЕО, ВХОДЯЩИЕ В КУРС: <hr>';
                    foreach ($course as $value) {
                        $video_model = $model->getvideomodel($value);
                        echo '<i class="icon-play-circle"></i> ';
                        echo Html::a(Html::encode($video_model->title), [ 'view', 'alias' => $video_model->alias], ['class' => 'course']);
                        echo '<br><br>';
                    }
                }
                ?>
            </div>
            <br>
            <br>
            <?= 'КОНСПЕКТЫ: <hr>' 
                . '<h3 class="icon-paper-clip"></h3> <span class="consp">' . $model->conspects. '</span>' ?>
            <div class="gift" id="gifter">
                <?php
                if (Yii::$app->user->can('administrateVideo')) {
                    echo '<br><br>Подарить видео:';
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
                    <?= Html::submitButton('Подарить', ['class' => 'btn btn-primary'], ['id' => 'gift-sbm']) ?>
                    <?php
                    ActiveForm::end();
                    Pjax::begin(['id' => 'gifter', 'formSelector' => '#gift', 'enablePushState' => false]);
                    Pjax::end();
                    echo '<br>';
                }
                if (Yii::$app->user->can('administrateVideo') || $model->_isAuthor) {
                    echo Html::a('Статистика', ['stat', 'id' => $model->id]);
                }
                ?>
            </div>
        </div>
        <div class="col-xs-9">
            <iframe width="745" height="400" src="<?= $model->embed ?>" frameborder="0" allowfullscreen></iframe>
            <div class="video_view__info">
                <span class="cl">Автор: </span><?= $model->user->username; ?>
                <b class="cl"><i class="icon-calendar"></i> </b><?= \Yii::$app->formatter->asDate($model->date); ?>
                <b class="cl"><i class="icon-time"></i> </b><?= $model->duration . ' мин.'; ?>
                <div class="right parsed" id="parsed-<?= $model->id ?>">
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
                <?php Pjax::begin(['id' => 'iparsed' . $model->id, 'linkSelector' => '#parsed-' . $model->id . ' a', 'enablePushState' => false]); ?>
                <?php Pjax::end(); ?>
                <hr>
            </div>
            <?= $model->description ?> 
            <br>
            <br>
            <?php
            echo 'Теги: ';
            $tags = explode(",", $model->tags);
            foreach ($tags as $value) {
                echo '<a class="tag" href="?VideoSearch[tags]=' . $value . '">' . $value . '</a>, ';
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
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Купить видео "<?= $model->title ?>"</h4>
            </div>
            <div class="modal-body">
                Вы действительно желаете купить это видео?
            </div>
            <div class="modal-footer">
                <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'val')->hiddenInput()->label(false); ?>
                <button type="button" class="btn btn-default" data-dismiss="modal">Нет</button>
                <?= Html::submitButton('Да, несомненно', ['class' => 'btn btn-primary']) ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>