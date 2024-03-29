<?php

namespace nill\bankroll;
use Yii;

/**
 * Module [[Slider]]
 * Yii2 Slider module.
 */
class Module extends \yii\base\Module
{
    public $controllerNamespace = 'nill\bankroll\controllers\backend';

    /**
     * @var string Image path
     */
    public $imagePath = '@statics/web/bankroll/images/';

    /**
     * @var string Images temporary path
     */
    public $imagesTempPath = '@statics/temp/bankroll/images/';

    /**
     * @var string Image URL
     */
    public $imageUrl = '/statics/bankroll/images';
    
    protected $_isBackend;
    
    /**
     * Translates a message to the specified language.
     *
     * This is a shortcut method of [[\yii\i18n\I18N::translate()]].
     *
     * The translation will be conducted according to the message category and the target language will be used.
     *
     * You can add parameters to a translation message that will be substituted with the corresponding value after
     * translation. The format for this is to use curly brackets around the parameter name as you can see in the following example:
     *
     * ```php
     * $username = 'Alexander';
     * echo \Yii::t('app', 'Hello, {username}!', ['username' => $username]);
     * ```
     *
     * Further formatting of message parameters is supported using the [PHP intl extensions](http://www.php.net/manual/en/intro.intl.php)
     * message formatter. See [[\yii\i18n\I18N::translate()]] for more details.
     *
     * @param string $category the message category.
     * @param string $message the message to be translated.
     * @param array $params the parameters that will be used to replace the corresponding placeholders in the message.
     * @param string $language the language code (e.g. `en-US`, `en`). If this is null, the current
     * [[\yii\base\Application::language|application language]] will be used.
     *
     * @return string the translated message.
     */
    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('nill/' . $category, $message, $params, $language);
    }


    public function init()
    {
        parent::init();

        if ($this->getIsBackend() === true) {
            $this->setViewPath('@nill/bankroll/views/backend');
        } else {
            $this->setViewPath('@nill/bankroll/views/frontend');
        }
    }

    /**
     * Check if module is used for backend application.
     *
     * @return boolean true if it's used for backend application
     */
    public function getIsBackend()
    {
        if ($this->_isBackend === null) {
            $this->_isBackend = strpos($this->controllerNamespace, 'backend') === false ? false : true;
        }

        return $this->_isBackend;
    }
}
