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
        <div class="blog">
            <div class="blog-item">
                <div class="blog-content row">
                    <div class="col-xs-7">
                        <iframe width="545" height="350" src="<?= $model->embed ?>" frameborder="0" allowfullscreen></iframe>
                        <h5 class=""><?= $model->title ?></h5>
                        <?php
                        if (Yii::$app->base->hasExtension('comments') && Yii::$app->user->can('viewComments') && $model->comments != 1) :
                            echo \vova07\comments\widgets\Comments::widget(
                                    [
                                        'model' => $model,
                                        'jsOptions' => [
                                            'offset' => 80
                                        ]
                                    ]
                            );
                        endif;
                        echo $this->render('_rating', [
                            'id' => $model->id,
                            'is_rating' => $model->_isRating,
                            'rating' => $model->rating,
                            'val' => $model->val,
                            'is_buy' => $model->_isBuy,
                        ])
                        ?>                       
                    </div>
                    <div class="col-xs-5">
                        <h3 class=""><?= \Yii::t('ru', 'Description'); ?><hr></h3>
                        <?= $model->description ?> 
                        <div class="gold">
                            Цена:<b> <?php echo $val = (!empty($model->val)) ? $model->val . ' </b>F$P <br>' : 'Бесплатно </b>' ?>
                                <br><?= $model->message ?>
                                </div>
                                <div class="gold">
                                    <?php
                                    $options = [
                                        'class' => 'btn btn-primary',
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
                                    <br>
                                    <br>
                                    <?= "<a href={$model->conspects}>Практика к тренировке: 3 барреля СБ против ББ</a>" ?>
                                    <br>
                                    <br>
                                    <?php
                                    if ($model->ids != NULL || $model->ids != '') {
                                        $course = explode(",", $model->ids);
                                        echo '<b>Курс:</b> <br>';
                                        foreach ($course as $value) {
                                            $video_model = $model->getvideomodel($value);
                                            echo Html::a(Html::encode($video_model->title), ['view', 'alias' => $video_model->alias]);
                                            echo '<br>';
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="gift" id="gifter">
                                    <?php
                                    if (Yii::$app->user->can('administrateVideo')) {
                                        $gift_form = ActiveForm::begin([
                                                    'id' => 'gift',
                                                    'method' => 'post',
                                                    'action' => ['gift'],
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
                                        ])
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
                                        echo Html::a('Статистика',['stat', 'id' => $model->id]);
                                    }
                                    ?>
                                </div>

                        </div>
                    </div>
                </div><!--/.blog-item-->
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