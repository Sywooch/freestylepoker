<?php

return [
    'id' => 'app-frontend',
    'name' => 'Freestylepoker',
    'basePath' => dirname(__DIR__),
    'defaultRoute' => 'site/default/index',
    'modules' => [
        'site' => [
            'class' => 'vova07\site\Module'
        ],
        'blogs' => [
            'controllerNamespace' => 'vova07\blogs\controllers\frontend'
        ],
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'sdi8s#fnj98jwiqiw;qfh!fjgh0d8f',
            'baseUrl' => ''
        ],
        'view' => [
            'theme' => 'vova07\themes\site\Theme'
        ],
        'errorHandler' => [
            'errorAction' => 'site/default/error'
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning']
                ]
            ]
        ],
        'urlManager' => require(__DIR__ . '/urlmanager.php'),
    ],
    'params' => require(__DIR__ . '/params.php')
];
