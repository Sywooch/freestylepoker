<?php

namespace app\modules\rooms\traits;

use app\modules\rooms\Module;

/**
 * Class ModuleTrait
 * @package vova07\blogs\traits
 * Implements `getModule` method, to receive current module instance.
 */
trait ModuleTrait
{
    /**
     * @var \vova07\blogs\Module|null Module instance
     */
    private $_module;

    /**
     * @return \vova07\blogs\Module|null Module instance
     */
    public function getModule()
    {
        if ($this->_module === null) {
            $this->_module = Module::getInstance();
        }
        return $this->_module;
    }
}
