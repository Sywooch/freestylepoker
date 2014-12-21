<?php

namespace app\modules\video;

use yii\base\BootstrapInterface;

/**
 * Gallery module bootstrap class.
 */
class Bootstrap implements BootstrapInterface {

    /**
     * @inheritdoc
     */
    public function bootstrap($app) {
        // Add module URL rules.
        $app->getUrlManager()->addRules(
                [
                    'video' => 'video/video/index',
                    'video/<_a:(create|contacts|captcha)>' => 'video/video/<_a>'
                ]
        );

        // Add module I18N category.
        $app->i18n->translations['ru*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@app/messages',
            'forceTranslation' => true,
            'fileMap' => [
                'ru' => 'ru.php',
            ]
        ];
    }
}
