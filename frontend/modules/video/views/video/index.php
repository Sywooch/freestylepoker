<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\LinkSorter;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\video\models\VideoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = Yii::t('ru','Videos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    echo ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'layout' => "{sorter}\n{items}\n{pager}",
        'itemView' => '_index_item',
        'sorter' => [
            'class' => LinkSorter::className(),
            'attributes' => ['author', 'date', 'val'],
            'options' => ['class' => 'list-inline sorter']
        ],
    ]);
    ?>
</div>
