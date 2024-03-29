<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\rooms\models\RoomsPromo */

$this->title = Yii::t('ru', 'Create {modelClass}', [
    'modelClass' => 'Rooms Promo',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('ru', 'Rooms Promos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rooms-promo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
