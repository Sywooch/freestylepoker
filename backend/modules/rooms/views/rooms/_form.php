<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use vova07\fileapi\Widget as FileAPI;
use kartik\select2\Select2;
use vova07\imperavi\Widget as Imperavi;

/* @var $this yii\web\View */
/* @var $model app\modules\rooms\models\Rooms */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rooms-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-sm-6">
        <?= $form->field($model, 'title')->textInput(['maxlength' => 100]) ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'net')->textInput(['maxlength' => 100]) ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'alias')->textInput(['maxlength' => 100]) ?>
    </div>
    <div class="col-sm-6">
        <?=
        $form->field($model, 'promo')->widget(Select2::classname(), [
            'options' => [
                'placeholder' => 'Select a state ...',
                'multiple' => true,
            ],
            'data' => $model->Promo,
            'pluginOptions' => [
//            'tags' => $model->Promo,
                'maximumInputLength' => 10,
                //'allowClear' => true
            ],
        ]);
        ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'info')->widget(
                Imperavi::className(),
                [
                    'settings' => [
                        'minHeight' => 70,
                    ]
                ]
            ) ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'snippet')->textarea(['rows' => 6]) ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'content')->widget(
                Imperavi::className(),
                [
                    'settings' => [
                        'minHeight' => 70,
                        'imageGetJson' => Url::to(['/rooms/rooms/imperavi-get']),
                        'imageUpload' => Url::to(['/rooms/rooms/imperavi-image-upload']),
                    ]
                ]
            ) ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'instruction')->widget(
                Imperavi::className(),
                [
                    'settings' => [
                        'minHeight' => 70,
                        'imageGetJson' => Url::to(['/rooms/rooms/imperavi-get']),
                        'imageUpload' => Url::to(['/rooms/rooms/imperavi-image-upload']),
                    ]
                ]
            ) ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'bonus')->textInput(['maxlength' => 100]) ?>
    </div>
    <div class="col-sm-6">
        <?=
        $form->field($model, 'logo')->widget(
                FileAPI::className(), [
            'settings' => [
                'url' => ['/rooms/rooms/fileapi-upload']
            ]
                ]
        )
        ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('ru', 'Create') : Yii::t('ru', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
