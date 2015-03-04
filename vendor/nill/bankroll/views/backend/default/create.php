<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\rooms\models\Bankroll */

$this->title = 'Create Bankroll';
$this->params['breadcrumbs'][] = ['label' => 'Bankrolls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bankroll-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
