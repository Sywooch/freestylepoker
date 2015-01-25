<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\rooms\models\RoomsPromo;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\modules\rooms\models\Rooms */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('ru', 'Rooms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rooms-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="box box-success row">
        <div class="col-sm-12">
            <?= Html::img('/statics/web/rooms/previews/' . $model->logo, ['style' => 'padding:10px; float:left']) ?>
            <h4>
                <?= Html::encode($model->title); ?>
            </h4>
            <?= Html::encode($model->snippet); ?>
        </div>
        <div class="col-sm-12 room__info">
            <h4>
                Особенности:
            </h4>
            <hr>
            <?= $model->info; ?>
        </div>
        <div class="col-sm-12 room__content">
            <h4>
                Описание:
            </h4>
            <hr>
            <?= $model->content; ?>
        </div>
        <div class="col-sm-12 room__promo">
            <h4>
                Акции:
            </h4>
            <hr>
            <?php
            foreach ($model->promo as $value) {
                $promo = RoomsPromo::findOne($value);
                echo '<div class="promo col-sm-4">';
                echo Html::a(Html::encode($promo->name), ['roomspromo/view', 'alias' => $promo->alias]);
                echo '<br>';
                echo $promo->text;
                echo '<br>';
                echo '</div>';
            }
            ?>
        </div>
        <div class="col-sm-12 room__instruction">
            <h4>
                Инструкции:
            </h4>
            <hr>
            <?= $model->instruction; ?>
        </div>

        <div class="col-sm-12 accounts" id="accounts">
            <h4>
                Привязать аккаунт:
            </h4>
            <hr>
            <?php
            if (!$model->isAccount && !\Yii::$app->user->isGuest) {
                $form = ActiveForm::begin([
                            'id' => 'account',
                            'method' => 'post',
                            'action' => ['account'],
                ]);

                echo $form->field($model, 'nickname')->textInput(['style' => 'width:300px']);
                ?>
                <?= $form->field($model, 'id')->hiddenInput()->label(false); ?>
                <?= Html::submitButton('Привязать', ['class' => 'btn btn-primary'], ['id' => 'sbm']) ?>
                <?php
                ActiveForm::end();
                Pjax::begin(['id' => 'accounts', 'formSelector' => '#account', 'enablePushState' => false]);
                Pjax::end();
                echo '<br>';
            } 
            elseif (\Yii::$app->user->isGuest) {
                echo 'Для регистрации в покер-руме войдите на сайт';
            }
            elseif($model->isAccount && $model->Account_status) {
                echo 'Ник в руме: <b>'. $model->Account_status . '</b>';
            }
            else {
                echo 'Ваш аккаунт ожидает подтветржения';
            }
            ?>
        </div>

    </div>
</div>
</div>
