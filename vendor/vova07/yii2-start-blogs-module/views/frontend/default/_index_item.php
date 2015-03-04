<?php

/**
 * Blog list item view.
 *
 * @var \yii\web\View $this View
 * @var \vova07\blogs\models\frontend\Blog $model Model
 */
use vova07\blogs\Module;
use yii\helpers\Html;
?>

<?php if ($model->preview_url) : ?>
    <?=
    Html::a(
            Html::img(
                    $model->urlAttribute('preview_url'), ['class' => 'article_img', 'alt' => $model->title]
            ), ['view', 'id' => $model->id, 'alias' => $model->alias]
    )
    ?>
<?php endif; ?>

<div class="blog-content">
    <?= Html::a($model->title, ['view', 'id' => $model->id, 'alias' => $model->alias], ['class' => 'article_title']) ?>
    <div class="article_snippet">
        <?= $model->snippet ?>
    </div>
    <div class="entry-meta">
        <small><i class="icon-calendar"></i> <?= $model->created ?></small>
        <small><i class="icon-eye-open"></i> <?= $model->views ?></small>
    </div>
    <?= '<b class="icon-comment"> </b>' . $model->CommentsCount . ' '; ?>
    <?php
//    Html::a(
//            Module::t('blogs', 'FRONTEND_INDEX_READ_MORE_BTN') . ' <i class="icon-angle-right"></i>', ['view', 'id' => $model->id, 'alias' => $model->alias], ['class' => 'btn btn-default']
//    )
    ?>
</div>