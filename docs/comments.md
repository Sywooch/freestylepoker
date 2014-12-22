Comments
========

>BUGFIX: (17): Yii::$app->assetManager->publish('@vova07/themes/site/assets/images/blog/avatar3.png')[1]; 
-asstets not exist

Install and Usage
-----------------

1. Add or change `models\Comment.php` - `use nill\users\models\frontend\User;`

2. Add your model in **Admin Panel** _Comments - Managmet Models_

**Exemple:** app\modules\video\models\Video;

3. Add widget in your `view` file:

```
<?php
if (Yii::$app->base->hasExtension('comments') && Yii::$app->user->can('viewComments')) :
    echo \vova07\comments\widgets\Comments::widget(
            [
                'model' => $model,
                'jsOptions' => [
                    'offset' => 80
                ]
            ]
    );
endif;
?>
```