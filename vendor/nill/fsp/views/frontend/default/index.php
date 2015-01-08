<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use vova07\themes\admin\widgets\Box;
use vova07\themes\admin\widgets\GridView;

$this->title = yii::t('ru', 'Video Users');
$this->params['subtitle'] = yii::t('ru', 'Video Users Panel');
$this->params['breadcrumbs'] = [
    $this->title
];
$gridId = 'blogs-grid';
$gridConfig = [
    'id' => $gridId,
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'fsp',
        'comment',
        'date',
    ]
];
?>

<?php
$dt = date('d.m.Y [H:i:s]');
echo "Текущая дата и время: $dt";
?>

<div class="row">
    <div class="col-xs-12">
        <?php
        Box::begin(
                [
                    'title' => $this->params['subtitle'],
                    'bodyOptions' => [
                        'class' => 'table-responsive'
                    ],
                    //'buttonsTemplate' => $boxButtons,
                    'grid' => $gridId
                ]
        );
        ?>
        <?= GridView::widget($gridConfig); ?>
        <?php Box::end(); ?>
    </div>
</div>