<?php

Yii::setAlias('backend', dirname(__DIR__));

return [
    'id' => 'app-backend',
    'name' => 'Freestylepoker',
    'basePath' => dirname(__DIR__),
    'defaultRoute' => 'admin/default/index',
    'modules' => [
        'fsp' => [
            'controllerNamespace' => 'nill\fsp\controllers\backend',
        ],
        'admin' => [
            'class' => 'vova07\admin\Module'
        ],
        'users' => [
            'controllerNamespace' => 'nill\users\controllers\backend'
        ],
        'blogs' => [
            'controllerNamespace' => 'vova07\blogs\controllers\backend'
        ],
        'comments' => [
            'isBackend' => true
        ],
        'slider' => [
            'class' => 'nill\slider\Module',
        ],
        'statical' => [
            'class' => 'nill\statical\Module',
        ],
        'bankroll' => [
            'class' => 'nill\bankroll\Module',
        ],
        'blogs_category' => [
            'class' => 'nill\blogs_category\Module'
        ],
        'rbac' => [
            'class' => 'vova07\rbac\Module',
            'isBackend' => true
        ]
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => '7fdsf%dbYd&djsb#sn0mlsfo(kj^kf98dfh',
            'baseUrl' => '/backend'
        ],
        'urlManager' => [
            'rules' => [
                '' => 'admin/default/index',
                '<_m>/<_c>/<_a>' => '<_m>/<_c>/<_a>'
            ]
        ],
        'view' => [
            'theme' => 'vova07\themes\admin\Theme'
        ],
        'errorHandler' => [
            'errorAction' => 'admin/default/error'
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning']
                ]
            ]
        ]
    ],
    'params' => require(__DIR__ . '/params.php')
];
