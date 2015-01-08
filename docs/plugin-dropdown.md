Plugin Dropdown
===============

Install:
--------

[Install extension](https://github.com/himiklab/yii2-chained-dropdown-list-widget)

Usage
-----

1. Form: add `use himiklab\chained\ChainedDropDownList` and
```
echo $form->field($model, 'limit_id')->widget(
ChainedDropDownList::className(),
[
    'items'=>$model->getData($model->type_id),
    'remote' => [
        'id' => 'cat-id',
        'url' => Url::to(['video/asubcat/'])
    ],
    'options'=> ['id' => 'subcat-id', 'class'=>'form-control', 'prompt' => 'Выбрать'],
]
); 
```

2. Controllers: add filter behaviors and: 
```
public function actionAsubcat() {
    $out = [];
    if (isset($_GET['Video'])) {
        $parents = $_GET['Video'];
        if ($parents != null) {
            $cat = $parents['type_id'];
            $out = Video::getLimiteds($cat);
            echo Json::encode($out);
            return;
        }
    }
     echo Json::encode('');
}
```

3. Add to Model: 
```
public static function getLimiteds($cat_id) {
    $models = VideoLimits::find()->where(['type_id' => $cat_id])->asArray()->all();
    foreach ($models as $key => $value) {
        $data[] = [$value['id'] => $value['name']];
    }
    $a = [0 => [NULL => 'Выбрать']];
    $r = ArrayHelper::merge($a, $data);
    return $r;
}
```