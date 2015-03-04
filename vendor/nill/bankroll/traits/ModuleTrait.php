<?php

namespace nill\bankroll\traits;

use nill\bankroll\Module;

/**
 * Class ModuleTrait
 * @package nill\bankroll\traits
 * Implements `getModule` method, to receive current module instance.
 */
trait ModuleTrait
{
    /**
     * @var \nill\bankroll\Module|null Module instance
     */
    private $_module;

    /**
     * @return \nill\bankroll\Module|null Module instance
     */
    public function getModule()
    {
        if ($this->_module === null) {
            $this->_module = Module::getInstance();
        }
        return $this->_module;
    }
}
