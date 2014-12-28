<?php

use yii\helpers\Html;
use app\modules\video\models\VideoUsr;
use app\modules\video\models\Videoon;
use yii\widgets\Pjax;
use vova07\comments\models\Comment;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="col-sm-12">
    <h3>
        <?= Html::a(Html::encode($model->title), ['view', 'id' => $model->id, 'alias' => $model->alias]); ?>

        <?= Html::img('/statics/web/video/previews/' . $model->preview, ['style' => 'width:100px; float:right; padding:0px']) ?>
    </h3>
</div>
<div class="col-sm-12">
    <?= '<b>Автор: </b>' . $model->author ?>
</div>
<div class="col-sm-12">
    <?= '<b>Описание: </b>' . $model->description; ?>
</div>
<div class="col-sm-12">
    <?php echo '<b>Теги: </b>';
        $tags = explode(" ", $model->tags);
        foreach ($tags as $value) {
            echo '<a href="?VideoSearch[tags]='.$value.'">#' .$value . '</a> ';
        }
    ?>
</div>
<div class="col-sm-3">
    <?= '<b>Дата: </b>' .Yii::$app->formatter->asDate($model->date); ?>
</div>
<div class="col-sm-9">
    <?= '<b>Цена: </b>' .$model->val.' '.Yii::t('ru','Val') ?>
</div>
<div class="col-sm-3">
    <?= '<b>Продолжительность: </b>' .$model->duration.' мин.' ?>
</div>
<div class="col-sm-3">
    <?php $comments_count = Comment::find()->where(['model_class'=> '2621821478','model_id' => $model->id])->count();
    ?>
    <?= '<b>Комментарии: </b>' .$comments_count.' '; ?>
</div>
<?php
// Если видео куплено отображать другим цветом
$cup = VideoUsr::findOne(['video_id' => $model->id, 'user_id' => Yii::$app->user->id]);

if ($cup != NULL) {
    $this->registerCss("div.item[data-key='{$model->id}']  { background: #00FFAE; }");
}

// Если видео разобрано сообщать
$on = Videoon::findOne(['video_id' => $model->id, 'user_id' => Yii::$app->user->id]);

if ($on != NULL) :
    ?>
    <div id="categoriese<?= $model->id ?>">

        <?php
        if(!Yii::$app->user->isGuest) {  echo Html::a(
                '[x] Убрать из разобраного', ['use', 'id' => $model->id], ['data-pjax' => '#formsectione' . $model->id]);
        } 
        ?>

    </div>
    <?php Pjax::begin(['id' => 'formsectione' . $model->id, 'linkSelector' => '#categoriese' . $model->id . ' a', 'enablePushState' => false]); ?>
    <?php Pjax::end(); ?>



<?php else: ?>


    <div id="categories<?= $model->id ?>">

        <?php
        if(!Yii::$app->user->isGuest) { echo  Html::a(
                '(&) Отметить разобранным', ['us', 'id' => $model->id], ['data-pjax' => '#formsection' . $model->id]);
        } else echo 'Вы не зарегестрированы'; ?>

    </div>
    <?php Pjax::begin(['id' => 'formsection' . $model->id, 'linkSelector' => '#categories' . $model->id . ' a', 'enablePushState' => false]); ?>
    <?php Pjax::end(); ?>

<?php endif; ?>