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

4. Add Comments Clock behavior in Commet Model:
```
'Comment_clock_behavior' => [
            'class' => \nill\comment_widget\behaviors\Comment_clock_behavior::className(),
        ],
```

Comment Widget
--------------

>PJAX:: If you want to use Ajax (autoupdate) uncomment: **PJAX begin()**, **PJAX end()** and **registerJs** in - **comment_clock**

Comment count
-------------

1. Add model to comments module - backend `comments/models/index/`

2. Add to **view** file code how in exemple: `<?= '<b class="icon-comment"> </b>' . $model->CommentsCount . ' '; ?>`

3. Add to model `CommentsCount` method: 
```
public function getCommentsCount() {
        $comments_count = Comment::find()->where(['model_class' => '4232574542', 'model_id' => $this->id])->count();
        return $comments_count;
    }
```
Where `model_class` - class your model, which can be taken from paragraph **1**