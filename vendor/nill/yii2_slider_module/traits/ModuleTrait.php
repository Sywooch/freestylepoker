<?php

namespace nill\slider\traits;

use nill\slider\Module;

/**
 * Class ModuleTrait
 * @package nill\slider\traits
 * Implements `getModule` method, to receive current module instance.
 */
trait ModuleTrait
{
    /**
     * @var \nill\slider\Module|null Module instance
     */
    private $_module;

    /**
     * @return \nill\slider\Module|null Module instance
     */
    public function getModule()
    {
        if ($this->_module === null) {
            $this->_module = Module::getInstance();
        }
        return $this->_module;
    }
}
