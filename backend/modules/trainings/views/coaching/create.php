<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\trainings\models\Coaching */

$this->title = Yii::t('ru', 'Create {modelClass}', [
    'modelClass' => 'Coaching',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('ru', 'Coachings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coaching-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
