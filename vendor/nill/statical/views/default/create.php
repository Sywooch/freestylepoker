<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\rooms\models\Statical */

$this->title = 'Create Statical';
$this->params['breadcrumbs'][] = ['label' => 'Staticals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="statical-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
