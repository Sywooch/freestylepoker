<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\trainings\models\Coaching */

$this->title = Yii::t('ru', 'Update {modelClass}: ', [
    'modelClass' => 'Coaching',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('ru', 'Coachings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('ru', 'Update');
?>
<div class="coaching-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
