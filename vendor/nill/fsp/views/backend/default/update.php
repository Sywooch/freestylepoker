<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model nill\fsp\models\backend\Fspstat */

$this->title = Yii::t('ru', 'Update {modelClass}: ', [
    'modelClass' => 'Fspstat',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('ru', 'Fspstats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('ru', 'Update');
?>
<div class="fspstat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
