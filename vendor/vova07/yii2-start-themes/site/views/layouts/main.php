<?php

/**
 * Theme main layout.
 *
 * @var \yii\web\View $this View
 * @var string $content Content
 */
use vova07\themes\site\widgets\Alert;
use yii\widgets\Breadcrumbs;
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <?= $this->render('//layouts/head') ?>
    </head>
    <body>
        <?php $this->beginBody(); ?>

        <header class="navbar navbar-inverse navbar-fixed-top wet-asphalt" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only"><?= Yii::t('vova07/themes/site', 'Toggle navigation') ?></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?= Yii::$app->homeUrl ?>">
                        <?= Yii::$app->name ?>
                    </a>
                </div>
                    <div class="navbar-left">
                        <div class="site_time">
                            <?= '<i class="icon-time"> </i>'.  date('H:i'); ?>
                        </div>
                    </div>
                <div class="navbar-right">
                    <?php
                    if (!Yii::$app->user->isGuest) {
                        echo '<div class="usertop">';
                        $user_id = Yii::$app->user->id;
                        $user = nill\users\models\User::findOne($user_id);
                        echo $user->username;
                        echo "<br><a class='usertop_fsp' href='/videousr/'>";
                        echo $user->gold == null ? '0 F$P' : $user->gold . ' F$P';
                        echo '</a>'
                        . \nill\comment_widget\Widget_cc::widget()
                        . '</div>';
                    }
                    ?>

                </div>
            </div>
        </header>
        <!--/header-->

        <?php if (!isset($this->params['noTitle'])) : ?>
            <section id="title" class="emerald">
                <div class="container">
                    <div class="row top-menu">
                        <?= $this->render('//layouts/top-menu') ?>
                    </div>
                </div>
            </section><!--/#title-->
        <?php endif; ?>
        
            <section id="" class="breadcrumbs">
            <div class="container">
                <div class="row">
                    <div>
                        <?=
                        Breadcrumbs::widget(
                                [
                                    'options' => [
                                        'class' => 'breadcrumb pull-left'
                                    ],
                                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []
                                ]
                        )
                        ?>
                    </div>
                </div>
            </div>
        </section>

        <?= Alert::widget(); ?>

        <section id="<?= isset($this->params['contentId']) ? $this->params['contentId'] : 'content' ?>" class="container">
            <?= $content ?>
        </section>
        <!--/#error-->

        <footer id="footer" class="midnight-blue">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        &copy; 2014 <?= Yii::$app->name ?>. <?= Yii::t('vova07/themes/site', 'All Rights Reserved') ?>.
                    </div>
                    <div class="col-sm-6">
                        <?= $this->render('//layouts/top-menu', ['footer' => true]) ?>
                    </div>
                </div>
            </div>
        </footer>
        <!--/#footer-->

        <?php $this->endBody(); ?>
    </body>
</html>
<?php $this->endPage(); ?>