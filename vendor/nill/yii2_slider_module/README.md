Yii2-Start module Slider
========================
Slideshow module for Yii2-Start application.

Requirements
------------

This module is used with Yii2-Start application
[yii2-start](https://github.com/vova07/yii2-start).


Installation
=============

Install via Composer
--------------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require nill/yii2-slider-module "dev-master"
```

or add

```
"nill/yii2-slider-module": "dev-master"
```

to the require section of your `composer.json` file.

Install from an Archive File
----------------------------

Download and extract the zip-file into the folder with your project


```
/my/path/to/yii2-start/vendor/nill/yii2_slider_module
```

Configuration
=============

- Add module to [backend] config section:

```
'modules' => [
    'slider' => [
        'class' => 'nill\slider\Module'
    ]
]
```

- Add alias to "common\config\aliases.php":

```
Yii::setAlias('backend', dirname(dirname(__DIR__)) . '/backend');
```

- Add module to extensions "vendor\yiisoft\extensions.php":

```
'nill/slider' => 
    array (
        'name' => 'nill/yii2_slider_module',
        'version' => '0.1.0.0',
        'alias' => 
        array (
            '@nill/slider' => $vendorDir . '/nill/yii2_slider_module',
    ),
    'bootstrap' => 'nill\\slider\\Bootstrap',
), 
```

- Create a new table in your database from file: `yii2_start_slider.sql`

OR: Apply migration with console commands:

`php yii migrate --migrationPath=@nill/slider/migrations`

- RBAC settings: For usage modules create Role "administrateSlider"

```
http://my.domain/backend/rbac/permissions/index/
```

You can also create other roles and change their behavior in the controller module
