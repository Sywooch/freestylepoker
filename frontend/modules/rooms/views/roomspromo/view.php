<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\rooms\models\RoomsPromo */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('ru', 'Rooms Promos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rooms-promo-view">

    <div class="row">
        <div class="col-sm-12">
            <?= Html::img('/statics/web/rooms/previews/' . $model->img, ['style' => 'padding:0 10px 10px; width: 200px; float:left']) ?>
            <h4>
                <?= Html::encode($this->title) ?>
            </h4>
            <?= $model->text; ?>
        </div>

    </div>
</div>

<?php
$query = nill\statical\models\Statical::findOne('1');
if ($query) {
    echo $query->text;
}

