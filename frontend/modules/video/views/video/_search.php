<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

$dir = \Yii::$app->controller->id;

/* @var $this yii\web\View */
/* @var $model app\modules\video\models\VideoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="video-search">
    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>
    <div class="video-filter">
        <div class="video_filter__title">
            <div class="col-sm-8">
                Фильтры 
                <?= Html::a('', '#', ['class' => 'btn-show icon-double-angle-down']) ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'title')->textInput(['placeholder' => 'Поиск'])->label(false) ?>
            </div>
        </div>
        <div class="video_filter__content">
            <div class="col-sm-4">
                <?= $form->field($model, 'author_id')->dropDownList($model->authors, ['prompt' => 'Автор...'])->label(false) ?>
            </div>
            <div class="col-sm-2">
                <?= $form->field($model, 'is_buy')->checkbox() ?>
            </div>
            <div class="col-sm-2">
                <?= $form->field($model, 'is_not_parsed')->checkbox() ?>
            </div>
            <div class="col-sm-2">
                <?= $form->field($model, 'from_val')->textInput(['placeholder' => 'Цена от'])->label(false) ?>
            </div>
            <div class="col-sm-2">
                <?= $form->field($model, 'to_val')->textInput(['placeholder' => 'Цена до'])->label(false) ?>
            </div>

            <br>

            <div class="col-sm-4">
                <?= $form->field($model, 'type_id')->dropDownList($model->typer, ['id' => 'type_id', 'prompt' => Yii::t('ru', 'Тип...')])->label(false); ?>
            </div>
            <div class="col-sm-2">
                <?= $form->field($model, 'no_val')->checkbox() ?>
            </div>
            <div class="col-sm-2">
                <?= $form->field($model, 'is_parsed')->checkbox() ?>
            </div>
            <div class="col-sm-4 text-right page_size">
                <?php
                echo 'Видео на странице: ' .
                Html::a('10', '?page_size=10', ['id' => 'p10']);
                echo ' ' .
                Html::a('20', '?page_size=20', ['id' => 'p20']);
                echo ' ' .
                Html::a('30', '?page_size=30', ['id' => 'p30']);
                ?>
            </div>
            <br>

            <div class="col-sm-2">
                <?php
                echo $form->field($model, 'limit_from')->widget(DepDrop::classname(), [
                    'options' => ['id' => 'limit_from'],
                    'data' => $model->getCurrentLimits($model->type_id),
                    'pluginOptions' => [
                        'depends' => ['type_id'],
                        'placeholder' => Yii::t('ru', 'Select...'),
                        'url' => Url::to(['video/getlimits/']),
                        'loadingText' => 'Загрузка ...'
                    ]
                ])->label(false);
                ?>
            </div>
            <div class="col-sm-2">
                <?php
                echo $form->field($model, 'limit_to')->widget(DepDrop::classname(), [
                    'options' => ['id' => 'limit_to'],
                    'data' => $model->getCurrentLimits($model->type_id),
                    'pluginOptions' => [
                        'depends' => ['type_id'],
                        'placeholder' => Yii::t('ru', 'Select...'),
                        'url' => Url::to(['video/getlimits/']),
                        'loadingText' => 'Загрузка ...'
                    ]
                ])->label(false);
                ?>
            </div>
            <div class="col-sm-2">
                <?= $form->field($model, 'is_not_buy')->checkbox() ?>
            </div>
            <div class="form-group text-right col-sm-6">
                <?= Html::submitButton(\Yii::t('ru', 'Search'), ['class' => 'btn btn-primary btn-sm']) ?>
                <?= Html::a(\Yii::t('ru', ''), "#", ['class' => 'btn btn-hide icon-double-angle-up']) ?>
                <?php // Html::resetButton(\Yii::t('ru', 'Reset'), ['class' => 'btn btn-danger btn-sm']) ?>
                <?php // Html::a(\Yii::t('ru', 'Back'), "/{$dir}/", ['class' => 'btn btn-info btn-sm']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>  
    </div>
</div>

<?php

$page_size = 10;
// COOKIES GET
if (($cookie = \Yii::$app->request->cookies->get('VIDEO_PAGE_SIZE')) !== null) {
    $page_size = $cookie->value;
}

if(\Yii::$app->request->get('page_size')) {
    $page_size = \Yii::$app->request->get('page_size');
}

$k = '$(document).ready(function() {'
        . '$("#p'.$page_size.'").addClass("page_size_active");'
        . '$(".btn-show").hide();'
        . '$("#videosearch-is_buy").click(function() {'
        . '$("#videosearch-is_not_buy").removeAttr("checked");'
        . '});'
        . '$("#videosearch-no_val").click(function() {'
        . '$("#videosearch-is_not_buy").removeAttr("checked");'
        . '});'
        . '$("#videosearch-is_not_buy").click(function() {'
        . '$("#videosearch-is_buy").removeAttr("checked");'
        . '$("#videosearch-no_val").removeAttr("checked");'
        . '});'
        . '$("#videosearch-is_not_parsed").click(function() {'
        . '$("#videosearch-is_parsed").removeAttr("checked");'
        . '});'
        . '$("#videosearch-is_parsed").click(function() {'
        . '$("#videosearch-is_not_parsed").removeAttr("checked");'
        . '});'
        . '$(".btn-hide").click(function() {'
        . '$(".video_filter__content").slideUp();'
        . '$(".btn-show").show();'
        . '});'
        . '$(".btn-show").click(function() {'
        . '$(".video_filter__content").slideDown();'
        . '$(".btn-show").hide();'
        . '});'
        . '})';

$this->registerJs($k);
?>