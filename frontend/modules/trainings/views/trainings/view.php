<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\select2\Widget;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\modules\video\models\Video */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Trainings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

    <div class="container-fluid">
        <div class="blog">
            <div class="blog-item">
                <div class="blog-content row">
                    <div class="col-xs-7">
                        <h5 class=""><?= $model->title ?></h5>
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

                                
                                    $h = date('H')+1;
                                    $time = date($h.':i:s');
                                    $model->time_start;
                                    $date = Yii::$app->formatter->asTimestamp(date('d.m.Y'));
                                    if ($model->_isBuy == true && $date == $model->date &&  $time >= $model->time_start) {
                                        Html::addCssClass($options, 'hide');
                                        echo 'Ссылка: ' . $model->url;
                                    }
                                    
                                    if ($model->_isBuy == true) {
                                        Html::addCssClass($options, 'hide');
                                        echo 'Ссылка: ' . $model->url;
                                    }
                                    
                                    if (empty($model->val) && $date == $model->date &&  $time >= $model->time_start) {
                                        echo 'Ссылка: ' . $model->url;
                                    }

                                    if (Yii::$app->user->isGuest) {
                                        Html::addCssClass($options, 'disabled');
                                    }

                                    if (!empty($model->val)) {
                                        echo Html::button('Купить', $options);
                                    }
                                    ?>
                                </div>
                                <div class="gift" id="gifter">
                                    <?php
                                    if (Yii::$app->user->can('administrateTrainings')) {
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