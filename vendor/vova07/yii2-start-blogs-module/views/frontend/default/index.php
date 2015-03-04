<?php

/**
 * Blog list page view.
 *
 * @var \yii\web\View $this View
 * @var \yii\data\ActiveDataProvider $dataProvider DataProvider
 */
use vova07\blogs\Module;
use yii\widgets\ListView;
use nill\blogs_category\widgets\WidgetCategory;

$this->title = Module::t('blogs', 'FRONTEND_INDEX_TITLE');
$this->params['breadcrumbs'][] = $this->title;
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
        <div class="article_desc">Приветствую, уважаемый читатель. Сегодня ты стоишь в начале своего покерного пути. И, как известно, дорога в тысячу миль начинается с одного шага. И этим шагом для тебя, конечно, будет знакомство с основами игры в Техасский холдем.
        </div>
        <?= WidgetCategory::widget(); ?>
        <?=
        ListView::widget(
                [
                    'dataProvider' => $dataProvider,
                    'layout' => "{items}\n{pager}",
                    'itemView' => '_index_item',
                    'options' => [
                        'class' => ''
                    ],
                    'itemOptions' => [
                        'class' => 'blog-item',
                        'tag' => 'article'
                    ]
                ]
        );
        ?>
    </div>
</div>