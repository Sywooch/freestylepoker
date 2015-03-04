<?php

/**
 * Blog page view.
 *
 * @var \yii\web\View $this View
 * @var \vova07\blogs\models\frontend\Blog $model Model
 */
use vova07\base\helpers\System;
use vova07\blogs\Module;
use yii\helpers\Html;

$this->title = $model['title'];
$this->params['breadcrumbs'] = [
    [
        'label' => Module::t('blogs', 'BACKEND_INDEX_TITLE'),
        'url' => ['index']
    ],
    $this->title
];
?>
<div class="row">
    <aside class="col-sm-3 col-sm-push-9">
        <div class="widget ads">
            <div class="row">
                <div class="col-xs-6">
                    <img class="img-responsive img-rounded" src="<?= $this->assetManager->publish('@vova07/themes/site/assets/images/ads/ad1.png')[1] ?>" alt="Ads" />
                </div>

                <div class="col-xs-6">
                    <img class="img-responsive img-rounded" src="<?= $this->assetManager->publish('@vova07/themes/site/assets/images/ads/ad2.png')[1] ?>" alt="Ads" />
                </div>
            </div>
            <p> </p>
            <div class="row">
                <div class="col-xs-6">
                    <img class="img-responsive img-rounded" src="<?= $this->assetManager->publish('@vova07/themes/site/assets/images/ads/ad3.png')[1] ?>" alt="Ads" />
                </div>

                <div class="col-xs-6">
                    <img class="img-responsive img-rounded" src="<?= $this->assetManager->publish('@vova07/themes/site/assets/images/ads/ad4.png')[1] ?>" alt="Ads" />
                </div>
            </div>
        </div><!--/.ads-->
    </aside>

    <div class="col-sm-9 col-sm-pull-3">
        <div class="article_title">
            <div class="article_title_img">
                <?= Html::img(Yii::$app->assetManager->publish('@vova07/themes/site/assets/images/article.png')[1], ['class' => '']) ?>
            </div>
            <?= Html::a($model->title, ['view', 'id' => $model->id, 'alias' => $model->alias], ['class' => 'article_title']) ?>
        </div>
        <div class="entry-meta">
                        <span><i class="icon-calendar"></i> <?= $model->created ?></span>
                        <span><i class="icon-eye-open"></i> <?= $model->views ?></span>
                    </div>
        <div class="">
            <div class="blog-item">
                <div class="article_snippet_view"><?php if ($model->preview_url) : ?>
                        <?=
                        Html::img(
                                $model->urlAttribute('preview_url'), ['class' => 'article_img', 'alt' => $model->title]
                        )
                        ?>
                    <?php endif; ?>
                    <div class="article_snippet">
                        <?= $model->snippet ?>
                    </div>
                </div>

                <div class="blog-content">

                    
                    <?= $model->content ?>

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

                </div>
            </div><!--/.blog-item-->
        </div>
    </div><!--/.col-md-8-->
</div><!--/.row-->