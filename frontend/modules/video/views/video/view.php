<?php

use yii\widgets\DetailView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\video\models\Video */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

    <div class="container-fluid">
        <div class="blog">
            <div class="blog-item">
                <div class="blog-content row">
                    <div class="col-xs-7">
                        <?= $model->embed ?>
                        <h5 class=""><?= $model->title ?></h5>
                    </div>
                    <div class="col-xs-5">
                    <h3 class=""><?= \Yii::t('ru','Description'); ?><hr></h3>
                        <?= $model->description ?>
                    </div>
                </div>
            </div><!--/.blog-item-->
        </div>
    </div><!--/.col-md-8-->
</div><!--/.row-->


</div>
