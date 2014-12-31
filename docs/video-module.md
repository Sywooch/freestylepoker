Video Module
============

This module is used to display video. It also includes additional functions: 
the purchase of video and statistics model.

****BUG POST:**** 1: create custom.js in **admin-template** for add EVENT on checkbox "SECTION"

>All Events **_form** - `video/video/update` or `video/video/create` implements in `theme/admin/js/custom.js`

***BUG POST: 2:*** `vendor\bower\jquery-ui\ui\i18n\datepicker-ru` **copy** `datepicker-ru_RU`

vendor\bower\jquery-ui\ui\i18n

>All controllers Video module includes RBAC Behavior from B[action]Video, example: 

**VideoUsrController**
```
...
    $behaviors['access']['rules'][] = [
                'allow' => true,
                'actions' => ['create'],
                'roles' => ['BCreateVideo']
            ];
...
```

Configuration
-------------
- Add kartik-v DepDrop for dependent-dropdown @dropDownList()

