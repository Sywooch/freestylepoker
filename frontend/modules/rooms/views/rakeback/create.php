<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\rooms\models\Rakeback */

$this->title = Yii::t('ru', 'Create Rakeback');

$this->params['breadcrumbs'][] = ['label' => Yii::t('ru', 'Rakebacks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php if (Yii::$app->session->hasFlash('success')): ?>

    <div class="flash-success">
        <?php echo 'Вы можете отправлять не более одной заявки в 10 минут'; ?>
    </div>

<?php else: ?>

    <div class="rakeback-create">
        <h4> <?= Html::img(Yii::$app->assetManager->publish('@vova07/themes/site/assets/images/rakeback.png')[1], ['class' => 'section_logo']) ?>
            <?= Html::encode($this->title) ?></h4>
        <p>
            Во всех покер румах, с каждого разыгрываемого банка взимается комиссия - рэйк. 
            Так за месяц игры может набежать солидная сумма. 
            Часть рейка мы возвращаем, эта часть называется рэйкбек.
        </p>
        <hr>
        <?=
        $this->render('_form', [
            'model' => $model,
        ])
        ?>
    </div>
<?php endif; ?>