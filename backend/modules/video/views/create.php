<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\video\models\Video */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Video',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Videos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>