<?php

/**
 * Blogs list view.
 *
 * @var \yii\base\View $this View
 * @var \yii\data\ActiveDataProvider $dataProvider Data provider
 * @var \vova07\blogs\models\backend\BlogSearch $searchModel Search model
 * @var array $statusArray Statuses array
 */
use vova07\themes\admin\widgets\Box;
use vova07\themes\admin\widgets\GridView;
use yii\helpers\Html;

$this->title = yii::t('ru', 'Video Users');
$this->params['subtitle'] = yii::t('ru', 'Buy Panel');
$this->params['subtitle2'] = yii::t('ru', 'Gift Panel');
$this->params['breadcrumbs'] = [
    $this->title
];
$gridId = 'blogs-grid';
$gridConfig = [
    'id' => $gridId,
    'dataProvider' => $dataProvider,
    //'filterModel' => $searchModel,
    'columns' => [
        'user.username',
        'fsp',
        'comment',
        [
            'attribute' => 'date',
            'format' => 'datetime',
        ],
        [
            'attribute' => 'cancel',
            'format' => 'html',
            'value' => function ($model) {
                if ($model->fsp < 0) {
                    return Html::a(
                                    Yii::t('ru', 'Cancel'), ['cancel', 'id' => $model['target_id'], 'user_id' => $model['user_id']]
                    );
                } else {
                    return '';
                }
            }
                ],
            ]
        ];
                
                
$gridId2 = 'gift-grid';
$gridConfig2 = [
    'id' => $gridId2,
    'dataProvider' => $dataProvider_gift,
    //'filterModel' => $searchModel,
    'columns' => [
        'user.username',
        'comment',
        [
            'attribute' => 'date',
            'format' => 'datetime',
        ],
        [
                    'attribute' => 'cancel',
                    'format' => 'html',
                    'value' => function ($model) {
                        if ($model->category == 1) {
                            return Html::a(
                                            Yii::t('ru', 'Cancel'), ['cancel_gift', 'id' => $model['target_id'], 'to_id' => $model['to_id']]
                            );
                        } else {
                            return '';
                        }
                    }
                        ],
                    ]
                ];
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
                            'grid' => $gridId
                        ]
                );
                ?>
                <?= GridView::widget($gridConfig); ?>
                <?php Box::end(); ?>
    </div>
            <div class="col-xs-12">
                        <?php
                        Box::begin(
                                [
                                    'title' => $this->params['subtitle2'],
                                    'bodyOptions' => [
                                        'class' => 'table-responsive'
                                    ],
                                    'grid' => $gridId2
                                ]
                        );
                        ?>
                        <?= GridView::widget($gridConfig2); ?>
                        <?php Box::end(); ?>
            </div>
</div>