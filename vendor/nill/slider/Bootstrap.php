<?php

namespace nill\slider;

use yii\base\BootstrapInterface;

/**
 * Slider module bootstrap class.
 */
class Bootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        // Add module URL rules.
        $app->getUrlManager()->addRules(
            [
                'POST <_m:slider>' => '<_m>/user/create',
                '<_m:slider>' => '<_m>/default/index',
                '<_m:slider>/<id:\d+>-<alias:[a-zA-Z0-9_-]{1,100}+>' => '<_m>/default/view',
            ]
        );

        // Add module I18N category.
        if (!isset($app->i18n->translations['nill/slider']) && !isset($app->i18n->translations['nill/*'])) {
            $app->i18n->translations['nill/slider'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@nill/slider/messages',
                'forceTranslation' => true,
                'fileMap' => [
                    'nill/slider' => 'slider.php',
                ]
            ];
        }
    }
}
