<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

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
                        <?= $model->embed ?>
                        <h5 class=""><?= $model->title ?></h5>
                        <?php
                        if (Yii::$app->base->hasExtension('comments') && Yii::$app->user->can('viewComments')) :
                            echo \vova07\comments\widgets\Comments::widget(
                                    [
                                        'model' => $model,
                                        'jsOptions' => [
                                            'offset' => 80
                                        ]
                                    ]
                            );
                        endif;
                        ?>
                    </div>
                    <div class="col-xs-5">
                        <h3 class=""><?= \Yii::t('ru', 'Description'); ?><hr></h3>
                        <?= $model->description ?> 
                        <div class="gold">
                            Цена:<b> <?= $model->val ?> </b>F$P <br>
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

                            if (Yii::$app->user->isGuest || $model->getIsBuy($model->id)==true) {
                                Html::addCssClass($options, 'disabled');
                            }

                            echo Html::button('Купить', $options);
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
