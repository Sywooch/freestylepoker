<?php

namespace app\modules\trainings;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\trainings\controllers';
    
    /**
     * @var boolean Whether posts need to be moderated before publishing
     */
    public $moderation = false;

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
