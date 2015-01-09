Video Module
============

This module is used to display video. It also includes additional functions: 
the purchase of video and statistics model.

***BUG Raport 1:***  create `custom.js` in **admin-template** for add EVENT on checkbox "SECTION"

>All **JS** Events **_form** - `video/video/update` or `video/video/create` implements in `theme/admin/js/custom.js`

***BUG Raport 2:*** `vendor\bower\jquery-ui\ui\i18n\datepicker-ru` **copy and rename** `datepicker-ru_RU`

vendor\bower\jquery-ui\ui\i18n

***BUG Raport 3:*** _Disable of limit field no correct. Need to make its else!_ 

***BUG Raport 4:*** Comments model. Frontend Video Model:
```
public function getCommentsCount() {
    $comments_count = Comment::find()->where(['model_class' => '2621821478', 'model_id' => $this->id])->count();
    return $comments_count;
}
``` 

`'model_class' => '2621821478'` - need to make an **independent**

####Controllers

>All controllers Video module includes RBAC Behavior from B[action]Video.

Need extends from `admin controller`. For it change: `use yii\web\Controller` on `use vova07\admin\components\Controller`

Exemple: **VideoUsrController**
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

[kartik-v DepDrop](https://github.com/kartik-v/yii2-widget-depdrop)

- Add himiklab SortableGrid

[SortableGrid](https://github.com/himiklab/yii2-sortable-grid-view-widget)

>For work with Video need add in `SortableGridBehavior` extensions next: 

```
public function gridSort($items) {
...
$this->reSort();
}

private function reSort() {
    $models = \app\modules\video\models\Video::find()->orderBy('sortOrder')->all();
    $i = 0;
    foreach ($models as $value) {
        $value->updateAttributes(['sortOrder' => $i]);
        ++$i;
    }
}
```

_this function add resort for video._

