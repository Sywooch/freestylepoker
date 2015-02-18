<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\select2\Widget;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\modules\video\models\Video */

//$this->title = $model->title;
//$this->params['breadcrumbs'][] = ['label' => 'Trainings', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;

echo Html::a($model['title'], '', [
    'class' => 'training_title',
    'data-toggle' => 'modal',
    'data-target' => '#training' . $model->id]
) . '<br>' . \Yii::t('ru', 'Trainer') . ': ' . Html::a(
        $model->user->username, ['trainings/view', 'alias' => $model['alias']], ['class' => 'training_author']
);
Modal::begin([
    'header' => "<h4>{$model->title}</h4>",
    'id' => 'training' . $model->id,
    'options' => ['class' => 'training-modal fade modal'],
        //'toggleButton' => ['label' => \Yii::t('ru', 'Buy'), 'class' => 'training_btn btn btn-primary buy'],
]);
?>
<div class="">
    <div class="container-fluid">
        <div class="trainings-view">
            <div class="blog-item">
                <div class="blog-content">
                    <div class="col-sm-12 training_line row">
                        <div class="b_r left">
                            <?=
                            '<div class="">' . \Yii::$app->formatter->asDate($model->date) . '</div>';
                            ?>
                        </div>
                        <div class="b_r left ">
                            <?=
                            '<div class="trainings_time">' . \Yii::$app->formatter->asTime($model->time_start, 'H:i') . ' - '
                            . \Yii::$app->formatter->asTime($model->time_end, 'H:i') . ' МСК</div>'
                            ?>
                        </div>
                        <div class="left">
                            <?= '<span class="cl">' . \Yii::t('ru', 'Type') . ':</span> ' . $model->type->name . ' ' . $model->limit->name ?></div>
                        <div class="right centered-text">
                            <?php
                            if (\Yii::$app->user->isGuest) {
                                echo '';
                            } else if ($model->_isBuy == true || $model->_isAuthor || \Yii::$app->user->can('administrateTraining')) {
                                echo '<a class="training_btn_go">' . $model->password . ' '
                                . '<i class="icon-chevron-sign-right"></i> </a>';
                            } elseif (!$model->_isBuy && $model->val) {
                                ?>
                                <span class="cl"><?= \Yii::t('ru', 'Price') ?>: </span>
                                <?php
                                echo $val = (!empty($model->val)) ? $model->val
                                . ' &nbsp;<span class="buyed"></span> <br>' : \Yii::t('ru', 'Free video')
                                ?>
                                <?php
                                $form = ActiveForm::begin([
                                            'method' => 'post',
                                            'action' => ['view', 'id' => $model->id],
                                ]);
                                echo $form->field($model, 'val')->hiddenInput()->label(false);
                                echo Html::submitButton(\Yii::t('ru', 'Buy'), ['class' => 'training_btn btn btn-primary buy']);
                                ActiveForm::end();
                            } elseif (!$model->val) {
                                echo '';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-xs-12 row">
                        <?= $model->description ?> 
                        <div class="gold">

                            <br><?= $model->message ?>
                        </div>
                        <div class="gold">
                            <?php
//                            $options = [
//                            'class' => 'btn btn-primary',
//                            'data-toggle' => 'modal',
//                            'data-target' => '#myModal',
//                            'title' => 'Купить доступ к просмотру'
//                            ];
//
//                            if ($model->_isBuy == true || $model->_isAuthor || \Yii::$app->user->can('administrateTraining')) {
//                            Html::addCssClass($options, 'hide');
//                            echo 'Ссылка: ' . $model->url;
//                            }
//
//                            if (empty($model->val)) {
//                            echo 'Ссылка: ' . $model->url;
//                            }
//
//                            if (Yii::$app->user->isGuest) {
//                            Html::addCssClass($options, 'disabled');
//                            }
//
//                            if (!empty($model->val)) {
//                            echo Html::button('Купить', $options);
//                            }
                            ?>
                        </div>
                        <div class="training_footer ofw">
                            <div class="left trainer">
                                <?=
                                \Yii::t('ru', 'Trainer') . ': ' . Html::a(
                                        $model->user->username, ['trainings/view', 'alias' => $model['alias']], ['class' => 'training_author']
                                );
                                ?>
                            </div>
                            <?php
                            if (\Yii::$app->user->isGuest) {
                                echo Html::tag('div', Html::img(Yii::$app->assetManager->publish('@vova07/themes/site/assets/images/login.png')[1])
                                        . Html::a('Войдите', ['/login']) . ' или '
                                        . Html::a('Зарегистрируйтесь', ['/signup']), ['class' => 'login_please right']);
                            } elseif ($model->_isBuy == true || $model->_isAuthor || \Yii::$app->user->can('administrateTraining') || empty($model->val)) {
                                echo Html::a(Html::img(Yii::$app->assetManager->publish('@vova07/themes/site/assets/images/trainings-w.png')[1], ['class' => 'trainings_logo'])
                                        . \Yii::t('ru', 'Go to training'), $model->url, ['class' => 'training_but right']);
                            } else {
                                ?>
                                <div class="training_but right">
                                    <?=
                                    Html::img(Yii::$app->assetManager->publish('@vova07/themes/site/assets/images/trainings-w.png')[1], ['class' => 'trainings_logo']);
                                    echo \Yii::t('ru', 'Go to training')
                                    ?>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="admin-block">
                            <div class="gift" id="gifter">
                                <?php
                                if (Yii::$app->user->can('administrateTrainings')) {
                                    $gift_form = ActiveForm::begin([
                                                'id' => 'gift',
                                                'method' => 'post',
                                                'action' => ['gift'],
                                    ]);
                                    ?>
                                    <?=
                                    $gift_form->field($model, 'author')->widget(Widget::className(), [
                                        'options' => [
                                            'prompt' => \Yii::t('ru', 'Select...'),
                                        ],
                                        'settings' => [
                                            'width' => '100%',
                                        ],
                                        'items' => $model->AllUsers,
                                    ])
                                    ?>
                                    <?= $gift_form->field($model, 'id')->hiddenInput()->label(false); ?>
                                    <?= Html::submitButton('Подарить', ['class' => 'btn btn-primary'], ['id' => 'gift-sbm']) ?>
                                    <?php
                                    ActiveForm::end();
                                    Pjax::begin(['id' => 'gifter', 'formSelector' => '#gift', 'enablePushState' => false]);
                                    Pjax::end();
                                    echo '<br>';
                                }
                                if (Yii::$app->user->can('administrateTrainings') || $model->_isAuthor) {
                                    echo Html::a('Статистика', ['stat', 'id' => $model->id]);
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.blog-item-->
        </div>
    </div><!--/.col-md-8-->
</div><!--/.row-->
<?php Modal::end(); ?>