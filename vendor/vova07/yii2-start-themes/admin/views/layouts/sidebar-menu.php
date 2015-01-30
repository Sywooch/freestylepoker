<?php

/**
 * Sidebar menu layout.
 *
 * @var \yii\web\View $this View
 */
use vova07\themes\admin\widgets\Menu;

echo Menu::widget(
        [
            'options' => [
                'class' => 'sidebar-menu'
            ],
            'items' => [
                [
                    'label' => Yii::t('vova07/themes/admin', 'Dashboard'),
                    'url' => Yii::$app->homeUrl,
                    'icon' => 'fa-dashboard',
                    'active' => Yii::$app->request->url === Yii::$app->homeUrl
                ],
                [
                    'label' => Yii::t('vova07/themes/admin', 'Users'),
                    'url' => ['/users/default/index'],
                    'icon' => 'fa-group',
                    'visible' => Yii::$app->user->can('administrateUsers') || Yii::$app->user->can('BViewUsers'),
                ],
                [
                    'label' => Yii::t('vova07/themes/admin', 'Videos'),
                    'url' => '#',
                    'icon' => 'fa-video-camera',
                    'visible' => Yii::$app->user->can('administrateVideo') || Yii::$app->user->can('BViewVideo'),
                    'items' => [
                        [
                            'label' => Yii::t('vova07/themes/admin', 'All Videos'),
                            'url' => ['/video/video/index'],
                            'visible' => Yii::$app->user->can('administrateVideo') || Yii::$app->user->can('BViewVideo'),
                        ],
                        [
                            'label' => Yii::t('vova07/themes/admin', 'Video Users'),
                            'url' => ['/video/videousr/index'],
                            'visible' => Yii::$app->user->can('administrateVideo')
                        ],
                        [
                            'label' => Yii::t('vova07/themes/admin', 'Video Type'),
                            'url' => ['/video/videotype/index'],
                            'visible' => Yii::$app->user->can('administrateVideo')
                        ],
                        [
                            'label' => Yii::t('vova07/themes/admin', 'Video Limits'),
                            'url' => ['/video/videolimits/index'],
                            'visible' => Yii::$app->user->can('administrateVideo')
                        ],
                    ]
                ],
                [
                    'label' => Yii::t('vova07/themes/admin', 'Trainings'),
                    'url' => '#',
                    'icon' => 'fa-youtube-play',
                    'visible' => Yii::$app->user->can('administrateTrainings') || Yii::$app->user->can('BViewTrainings'),
                    'items' => [
                        [
                            'label' => Yii::t('vova07/themes/admin', 'Trainings'),
                            'url' => ['/trainings/trainings/index'],
                            'visible' => Yii::$app->user->can('administrateTrainings'),
                        ],
                        [
                            'label' => Yii::t('vova07/themes/admin', 'Coaching'),
                            'url' => ['/trainings/coaching/index'],
                            'visible' => Yii::$app->user->can('administrateTrainings'),
                        ]
                    ]
                ],
                [
                    'label' => Yii::t('vova07/themes/admin', 'Poker-rooms'),
                    'url' => '#',
                    'icon' => 'fa-flag',
                    'visible' => Yii::$app->user->can('administrateVideo') || Yii::$app->user->can('BViewVideo'),
                    'items' => [
                        [
                            'label' => Yii::t('vova07/themes/admin', 'Rooms'),
                            'url' => ['/rooms/rooms/index'],
                            'visible' => Yii::$app->user->can('administrateVideo') || Yii::$app->user->can('BViewVideo'),
                        ],
                        [
                            'label' => Yii::t('vova07/themes/admin', 'Rooms Promo'),
                            'url' => ['/rooms/roomspromo/index'],
                            'visible' => Yii::$app->user->can('administrateVideo'),
                        ],
                        [
                            'label' => Yii::t('vova07/themes/admin', 'Rooms Accounts'),
                            'url' => ['/rooms/roomsacc/index'],
                            'visible' => Yii::$app->user->can('administrateVideo'),
                        ],
                        [
                            'label' => Yii::t('vova07/themes/admin', 'Rakeback'),
                            'url' => ['/rooms/rakeback/index'],
                            'visible' => Yii::$app->user->can('administrateVideo'),
                        ],
                    ]
                ],
                [
                    'label' => Yii::t('vova07/themes/admin', 'FSP'),
                    'url' => ['/fsp/default/form'],
                    'icon' => 'fa-money',
                    'visible' => Yii::$app->user->can('administrateTrainings') || Yii::$app->user->can('BViewTrainings'),
                ],
//            [
//                'label' => Yii::t('vova07/themes/admin', 'Blogs'),
//                'url' => ['/blogs/default/index'],
//                'icon' => 'fa-book',
//                'visible' => Yii::$app->user->can('administrateBlogs') || Yii::$app->user->can('BViewBlogs'),
//            ],
                [
                    'label' => Yii::t('vova07/themes/admin', 'Comments'),
                    'url' => ['/comments/default/index'],
                    'icon' => 'fa-comments',
                    'visible' => Yii::$app->user->can('administrateComments') || Yii::$app->user->can('BViewCommentsModels') || Yii::$app->user->can('BViewComments'),
                    'items' => [
                        [
                            'label' => Yii::t('vova07/themes/admin', 'Comments'),
                            'url' => ['/comments/default/index'],
                            'visible' => Yii::$app->user->can('administrateComments') || Yii::$app->user->can('BViewComments'),
                        ],
                        [
                            'label' => Yii::t('vova07/themes/admin', 'Models management'),
                            'url' => ['/comments/models/index'],
                            'visible' => Yii::$app->user->can('administrateComments') || Yii::$app->user->can('BViewCommentsModels'),
                        ]
                    ]
                ],
                [
                    'label' => Yii::t('vova07/themes/admin', 'Access control'),
                    'url' => '#',
                    'icon' => 'fa-gavel',
                    'visible' => Yii::$app->user->can('administrateRbac') || Yii::$app->user->can('BViewRoles') || Yii::$app->user->can('BViewPermissions') || Yii::$app->user->can('BViewRules'),
                    'items' => [
                        [
                            'label' => Yii::t('vova07/themes/admin', 'Permissions'),
                            'url' => ['/rbac/permissions/index'],
                            'visible' => Yii::$app->user->can('administrateRbac') || Yii::$app->user->can('BViewPermissions')
                        ],
                        [
                            'label' => Yii::t('vova07/themes/admin', 'Roles'),
                            'url' => ['/rbac/roles/index'],
                            'visible' => Yii::$app->user->can('administrateRbac') || Yii::$app->user->can('BViewRoles')
                        ],
                        [
                            'label' => Yii::t('vova07/themes/admin', 'Rules'),
                            'url' => ['/rbac/rules/index'],
                            'visible' => Yii::$app->user->can('administrateRbac') || Yii::$app->user->can('BViewRules')
                        ]
                    ]
                ],
            ]
        ]
);
