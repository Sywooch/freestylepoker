<?php

namespace nill\users\traits;

use nill\users\Module;
use Yii;

/**
 * Class ModuleTrait
 * @package nill\users\traits
 * Implements `getModule` method, to receive current module instance.
 */
trait ModuleTrait
{
    /**
     * @var \nill\users\Module|null Module instance
     */
    private $_module;

    /**
     * @return \nill\users\Module|null Module instance
     */
    public function getModule()
    {
        if ($this->_module === null) {
            $module = Module::getInstance();
            if ($module instanceof Module) {
                $this->_module = $module;
            } else {
                $this->_module = Yii::$app->getModule('users');
            }
        }
        return $this->_module;
    }
}
