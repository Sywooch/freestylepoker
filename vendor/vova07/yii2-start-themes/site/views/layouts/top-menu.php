<?php

/**
 * Top menu view.
 *
 * @var \yii\web\View $this View
 */
use vova07\themes\site\widgets\Menu;

echo Menu::widget(
        [
            'options' => [
                'class' => isset($footer) ? 'pull-right' : 'nav navbar-nav'
            ],
            'itemOptions' => [
                'class' => 'm-2'
            ],
            'items' => [
                [
                    'label' => Yii::t('vova07/themes/site', 'Новости'),
                    'url' => ['/blogs'],
                ],
                [
                    'label' => Yii::t('vova07/themes/site', 'Видео'),
                    'url' => '#',
                    'template' => '<a href="{url}" class="dropdown-toggle" data-toggle="dropdown">{label} <i class="icon-angle-down"></i></a>',
                    'items' => [
                        [
                            'label' => Yii::t('vova07/themes/site', 'Видео'),
                            'url' => ['/video/video/index'],
                        ],
                        [
                            'label' => Yii::t('vova07/themes/site', 'Золотой фонд'),
                            'url' => ['/video/video_goldfund/index'],
                        ],
                        [
                            'label' => Yii::t('vova07/themes/site', 'Урок дня'),
                            'url' => ['/video/lessons/index'],
                        ]
                    ]
                ],
                [
                    'label' => Yii::t('vova07/themes/site', 'Тренировки'),
                    'url' => '#',
                    'template' => '<a href="{url}" class="dropdown-toggle" data-toggle="dropdown">{label} <i class="icon-angle-down"></i></a>',
                    'items' => [
                        [
                            'label' => Yii::t('vova07/themes/site', 'Тренировки'),
                            'url' => ['/trainings/trainings/index'],
                        ],
                        [
                            'label' => Yii::t('vova07/themes/site', 'Тренера'),
                            'url' => ['/trainings/coaching/index'],
                        ]
                    ]
                ],
                [
                    'label' => Yii::t('vova07/themes/admin', 'Poker-rooms'),
                    'url' => '#',
                    'template' => '<a href="{url}" class="dropdown-toggle" data-toggle="dropdown">{label} <i class="icon-angle-down"></i></a>',
                    'items' => [
                        [
                            'label' => Yii::t('vova07/themes/admin', 'Rooms'),
                            'url' => ['/rooms/rooms/index'],
                        ],
                        [
                            'label' => Yii::t('vova07/themes/admin', 'Rooms Promo'),
                            'url' => ['/rooms/roomspromo/index'],
                        ],
                        [
                            'label' => Yii::t('vova07/themes/admin', 'Rakeback'),
                            'url' => ['/rooms/rakeback/create'],
                        ],
                    ]
                ],
                [
                    'label' => Yii::t('vova07/themes/site', 'F$P'),
                    'url' => ['/users/guest/login'],
                ],
                [
                    'label' => Yii::t('vova07/themes/site', 'Форум'),
                    'url' => ['/users/guest/login'],
                ],
                [
                    'label' => Yii::t('vova07/themes/site', 'Sign In'),
                    'url' => ['/users/guest/login'],
                    'visible' => Yii::$app->user->isGuest
                ],
                [
                    'label' => Yii::t('vova07/themes/site', 'Sign Up'),
                    'url' => ['/users/guest/signup'],
                    'visible' => Yii::$app->user->isGuest
                ],
                [
                    'label' => Yii::t('vova07/themes/site', 'Settings'),
                    'url' => '#',
                    'template' => '<a href="{url}" class="dropdown-toggle" data-toggle="dropdown">{label} <i class="icon-angle-down"></i></a>',
                    'visible' => !Yii::$app->user->isGuest,
                    'items' => [
                        [
                            'label' => Yii::t('vova07/themes/site', 'Edit profile'),
                            'url' => ['/users/user/update']
                        ],
                        [
                            'label' => Yii::t('vova07/themes/site', 'Change email'),
                            'url' => ['/users/user/email']
                        ],
                        [
                            'label' => Yii::t('vova07/themes/site', 'Change password'),
                            'url' => ['/users/user/password']
                        ]
                    ]
                ],
                [
                    'label' => Yii::t('vova07/themes/site', 'Sign Out'),
                    'url' => ['/users/user/logout'],
                    'visible' => !Yii::$app->user->isGuest
                ]
            ]
        ]
);
