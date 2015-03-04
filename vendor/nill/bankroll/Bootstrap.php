<?php

namespace nill\bankroll;

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
                'POST <_m:bankroll>' => '<_m>/user/create',
                '<_m:bankroll>' => '<_m>/default/index',
                '<_m:bankroll>/<id:\d+>-<alias:[a-zA-Z0-9_-]{1,100}+>' => '<_m>/default/view',
            ]
        );

        // Add module I18N category.
        if (!isset($app->i18n->translations['nill/bankroll']) && !isset($app->i18n->translations['nill/*'])) {
            $app->i18n->translations['nill/bankroll'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@nill/bankroll/messages',
                'forceTranslation' => true,
                'fileMap' => [
                    'nill/bankroll' => 'bankroll.php',
                ]
            ];
        }
    }
}
