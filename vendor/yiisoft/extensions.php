<?php

$vendorDir = dirname(__DIR__);

return array(
    'nill/forum' =>
    array(
        'name' => 'nill/forum',
        'version' => '0.1.0.0',
        'alias' =>
        array(
            '@nill/forum' => $vendorDir . '/nill/forum',
        ),
    ),
    'vova07/yii2-start-rbac-module' =>
    array(
        'name' => 'vova07/yii2-start-rbac-module',
        'version' => '0.1.0.0',
        'alias' =>
        array(
            '@vova07/rbac' => $vendorDir . '/vova07/yii2-start-rbac-module',
        ),
        'bootstrap' => 'vova07\\rbac\\Bootstrap',
    ),
    'vova07/yii2-fileapi-widget' =>
    array(
        'name' => 'vova07/yii2-fileapi-widget',
        'version' => '0.1.1.0',
        'alias' =>
        array(
            '@vova07/fileapi' => $vendorDir . '/vova07/yii2-fileapi-widget',
        ),
    ),
    'yiisoft/yii2-bootstrap' =>
    array(
        'name' => 'yiisoft/yii2-bootstrap',
        'version' => '2.0.1.0',
        'alias' =>
        array(
            '@yii/bootstrap' => $vendorDir . '/yiisoft/yii2-bootstrap',
        ),
    ),
    'vova07/yii2-start-base' =>
    array(
        'name' => 'vova07/yii2-start-base',
        'version' => '0.1.0.0',
        'alias' =>
        array(
            '@vova07/base' => $vendorDir . '/vova07/yii2-start-base',
        ),
        'bootstrap' => 'vova07\\base\\Bootstrap',
    ),
    'yiisoft/yii2-jui' =>
    array(
        'name' => 'yiisoft/yii2-jui',
        'version' => '2.0.1.0',
        'alias' =>
        array(
            '@yii/jui' => $vendorDir . '/yiisoft/yii2-jui',
        ),
    ),
    'vova07/yii2-start-admin-module' =>
    array(
        'name' => 'vova07/yii2-start-admin-module',
        'version' => '0.1.0.0',
        'alias' =>
        array(
            '@vova07/admin' => $vendorDir . '/vova07/yii2-start-admin-module',
        ),
        'bootstrap' => 'vova07\\admin\\Bootstrap',
    ),
    'vova07/yii2-start-themes' =>
    array(
        'name' => 'vova07/yii2-start-themes',
        'version' => '0.1.2.0',
        'alias' =>
        array(
            '@vova07/themes' => $vendorDir . '/vova07/yii2-start-themes',
        ),
        'bootstrap' => 'vova07\\themes\\Bootstrap',
    ),
    'yiisoft/yii2-debug' =>
    array(
        'name' => 'yiisoft/yii2-debug',
        'version' => '2.0.1.0',
        'alias' =>
        array(
            '@yii/debug' => $vendorDir . '/yiisoft/yii2-debug',
        ),
    ),
    'yiisoft/yii2-gii' =>
    array(
        'name' => 'yiisoft/yii2-gii',
        'version' => '2.0.1.0',
        'alias' =>
        array(
            '@yii/gii' => $vendorDir . '/yiisoft/yii2-gii',
        ),
    ),
//    'vova07/yii2-start-users-module' =>
//    array(
//        'name' => 'vova07/yii2-start-users-module',
//        'version' => '0.2.3.0',
//        'alias' =>
//        array(
//            '@vova07/users' => $vendorDir . '/vova07/yii2-start-users-module',
//        ),
//        'bootstrap' => 'vova07\\users\\Bootstrap',
//    ),
    'nill/users' =>
    array(
        'name' => 'nill/users',
        'version' => '0.2.3.0',
        'alias' =>
        array(
            '@nill/users' => $vendorDir . '/nill/users',
        ),
        'bootstrap' => 'nill\\users\\Bootstrap',
    ),
);
