<?php

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'timeZone' => 'Europe/Moscow',
    'language' => 'ru_RU',
    'sourceLanguage' => 'en_US',
    'modules' => [
        'video' => [
            'class' => 'app\modules\video\Module',
        ],
        'fsp' => [
            'class' => 'nill\fsp\Module',
        ],
        'users' => [
            'class' => 'nill\users\Module',
            'robotEmail' => 'no-reply@domain.com',
            'robotName' => 'Robot'
        ],
//        'blogs' => [
//            'class' => 'vova07\blogs\Module'
//        ],
        'comments' => [
            'class' => 'vova07\comments\Module'
        ]
    ],
    'components' => [
//        'user' => [
//            'class' => 'yii\web\User',
//            'identityClass' => 'vova07\users\models\User',
//            'loginUrl' => ['/users/guest/login']
//        ],
        'phpBB' => [
            'class' => 'nill\forum\phpBB',
            'path' => dirname(dirname(__DIR__)) . '/forum',
        ],
        'user' => [
            'class' => 'nill\forum\PhpBBWebUser',
            'loginUrl' => ['/login'],
            'identityClass' => 'nill\users\models\frontend\User',
        // enable cookie-based authentication
        //'allowAutoLogin' => true,
        ],
//        'request' => [
//            'baseUrl' => $_SERVER['DOCUMENT_ROOT'] . $_SERVER['PHP_SELF'] != $_SERVER['SCRIPT_FILENAME'] ? 'http://' . $_SERVER['HTTP_HOST'] : '',
//        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@root/cache',
            'keyPrefix' => 'yii2start'
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'suffix' => '/'
        ],
        'assetManager' => [
            'linkAssets' => true
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
            'defaultRoles' => [
                'user'
            ],
            'itemFile' => '@vova07/rbac/data/items.php',
            'assignmentFile' => '@vova07/rbac/data/assignments.php',
            'ruleFile' => '@vova07/rbac/data/rules.php',
        ],
        'i18n' => [
            'translations' => [ 'ru' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'forceTranslation' => true,
                    'sourceLanguage' => 'en_US',
                    'fileMap' => [
                        'ru' => 'ru.php',
                    ],
                ],
            ],
        ],
        'formatter' => [
            'dateFormat' => 'dd.MM.y',
            'datetimeFormat' => 'HH:mm:ss dd.MM.y'
        ],
        'db' => require(__DIR__ . '/db.php')
    ],
    'params' => require(__DIR__ . '/params.php')
];
