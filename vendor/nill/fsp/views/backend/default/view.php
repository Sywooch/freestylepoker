<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model nill\fsp\models\backend\Fspstat */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('ru', 'Fspstats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fspstat-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('ru', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('ru', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('ru', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'fsp',
            'comment',
            'date',
            'target_id',
            'group_id',
        ],
    ]) ?>

</div>
