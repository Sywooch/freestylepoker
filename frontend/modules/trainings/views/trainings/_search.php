<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\trainings\models\TrainingsSearch */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="trainings-search">

    <?php
    $month[1] = "Январ";
    $month[2] = "Феврал";
    $month[3] = "Март";
    $month[4] = "Апрел";
    $month[5] = "Ма";
    $month[6] = "Июн";
    $month[7] = "Июл";
    $month[8] = "Август";
    $month[9] = "Сентябр";
    $month[10] = "Октябр";
    $month[11] = "Декабр";
    $month[12] = "Январ";

    $day[0] = "Воскресенье";
    $day[1] = "Понедельник";
    $day[2] = "Вторник";
    $day[3] = "Среда";
    $day[4] = "Четверг";
    $day[5] = "Пятница";
    $day[6] = "Суббота";

    $dnum = date("w");
    $mnum = date("n");
    $daym = date("d");
    $year = date("Y");

    $textday = $day[$dnum];
    $monthm = $month[$mnum];

    if ($mnum == 3 || $mnum == 8) {
        $k = "а";
    } else {
        $k = "я";
    }
    echo "Сегодня:  $textday, $daym $monthm$k $year г.";

    function dates_month($pd, $year) {

        $month = explode(".", $pd);
        $month = $month[1];

        $day[0] = "ВС";
        $day[1] = "ПН";
        $day[2] = "ВТ";
        $day[3] = "СР";
        $day[4] = "ЧТ";
        $day[5] = "ПТ";
        $day[6] = "СБ";

        $month_['01'] = "Январь";
        $month_['02'] = "Февраль";
        $month_['03'] = "Март";
        $month_['04'] = "Апрель";
        $month_['05'] = "Май";
        $month_['06'] = "Июнь";
        $month_['07'] = "Июль";
        $month_['08'] = "Август";
        $month_['09'] = "Сентябрь";
        $month_['10'] = "Октябрь";
        $month_['11'] = "Ноябрь";
        $month_['12'] = "Декабрь";

        $monthm = $month_[$month];


        $date = $pd;
        $date = new DateTime($date);
        $date_next = $date->modify('+1 month');
        //$date_next = $date->format('01.m.Y');
        
        if($date->format('d.m.Y') == date('01.m.Y')) {
        $dayr = date('d');
        $date_next = $date->format($dayr.'.m.Y');
        } else {
            $date_next = $date->format('01.m.Y');
        }

        $date = $pd;
        $date = new DateTime($date);
        $date_prev = $date->modify('-1 month');
        
        if($date->format('d.m.Y') == date('01.m.Y')) {
        $dayr = date('d');
        $date_prev = $date->format($dayr.'.m.Y');
        } else {
            $date_prev = $date->format('01.m.Y');
        }
        

        echo "<a href='?TrainingsSearch[date]=" . $date_prev . "'><< </a>";
        echo $monthm;
        echo "<a href='?TrainingsSearch[date]=" . $date_next . "'> >></a>";
        echo '<br>';

        $num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $dates_month = array();
        for ($i = 1; $i <= $num; $i++) {
            $mktime = mktime(0, 0, 0, $month, $i, $year);
            $dnum = date("w", $mktime);
            $textday = $day[$dnum];
            echo $textday . ' ';
        }
        echo '<br>';
        for ($i = 1; $i <= $num; $i++) {
            $mktime = mktime(0, 0, 0, $month, $i, $year);
            $date = date("d", $mktime);
            $datem = date("d.m.Y", $mktime);
            $dt = Yii::$app->formatter->asTimestamp($datem);

            $fin = app\modules\trainings\models\Trainings::findOne(['date' => $dt, 'status_id' => 1]);
            echo '<i>';
            if ($fin != NULL) {
                //echo '<a href="?TrainingsSearch[date]=' . $datem . '">' . $date . '</a> ';
                echo Html::a($date, ['', 'TrainingsSearch' => ['date' => $datem], 'month' => $month]) . ' ';
            } else {
                echo $date . ' ';
            }
            echo '</i>';
            $dates_month[$i] = $date;
        }
        //return $dates_month;
    }

    echo"<pre>";
    if (\Yii::$app->request->get()) {
        $get = (empty(Yii::$app->request->get())) ? NULL : Yii::$app->request->get();
        $pd = $get['TrainingsSearch'];
        $pd = $pd['date'];
    } else {
        $pd = date('d.m.Y');
    }
    dates_month($pd, 2015);
    echo"</pre>";
    ?>  

</div>
<?php
$get = (empty(Yii::$app->request->get())) ? NULL : Yii::$app->request->get();
$pd = $get['TrainingsSearch'];
$pd = $pd['date'];

$month = explode(".", $pd);

if (!$pd) {
    if (Yii::$app->request->get() && $month[1] != date('m')) {
        $x = 'not';
        $dater[0] = 1;
        $x0 = $dater[0];
        $x0 = str_pad($x0, 2, '0', STR_PAD_LEFT);
        $x1 = $dater[0] + 1;
        $x1 = str_pad($x1, 2, '0', STR_PAD_LEFT);
        $x2 = $dater[0] + 2;
        $x2 = str_pad($x2, 2, '0', STR_PAD_LEFT);
        $x3 = $dater[0] + 3;
        $x3 = str_pad($x3, 2, '0', STR_PAD_LEFT);
        $x4 = $dater[0] + 4;
        $x4 = str_pad($x4, 2, '0', STR_PAD_LEFT);
        $x5 = $dater[0] + 5;
        $x5 = str_pad($x5, 2, '0', STR_PAD_LEFT);
        $x6 = $dater[0] + 6;
        $x6 = str_pad($x6, 2, '0', STR_PAD_LEFT);
    } else {
        $x = date('d');
        $x0 = date('d');
        $x1 = date('d') + 1;
        $x2 = date('d') + 2;
        $x3 = date('d') + 3;
        $x4 = date('d') + 4;
        $x5 = date('d') + 5;
        $x6 = date('d') + 6;
    }
} else {
    if (Yii::$app->request->get() && $month[1] != date('m')) {
        $x = 'not';
        $dater = explode(".", $pd);
        $x0 = $dater[0];
        $x0 = str_pad($x0, 2, '0', STR_PAD_LEFT);
        $x1 = $dater[0] + 1;
        $x1 = str_pad($x1, 2, '0', STR_PAD_LEFT);
        $x2 = $dater[0] + 2;
        $x2 = str_pad($x2, 2, '0', STR_PAD_LEFT);
        $x3 = $dater[0] + 3;
        $x3 = str_pad($x3, 2, '0', STR_PAD_LEFT);
        $x4 = $dater[0] + 4;
        $x4 = str_pad($x4, 2, '0', STR_PAD_LEFT);
        $x5 = $dater[0] + 5;
        $x5 = str_pad($x5, 2, '0', STR_PAD_LEFT);
        $x6 = $dater[0] + 6;
        $x6 = str_pad($x6, 2, '0', STR_PAD_LEFT);
    } else {
        $x = date('d');
        $dater = explode(".", $pd);
        $x0 = $dater[0];
        $x0 = str_pad($x0, 2, '0', STR_PAD_LEFT);
        $x1 = $dater[0] + 1;
        $x1 = str_pad($x1, 2, '0', STR_PAD_LEFT);
        $x2 = $dater[0] + 2;
        $x2 = str_pad($x2, 2, '0', STR_PAD_LEFT);
        $x3 = $dater[0] + 3;
        $x3 = str_pad($x3, 2, '0', STR_PAD_LEFT);
        $x4 = $dater[0] + 4;
        $x4 = str_pad($x4, 2, '0', STR_PAD_LEFT);
        $x5 = $dater[0] + 5;
        $x5 = str_pad($x5, 2, '0', STR_PAD_LEFT);
        $x6 = $dater[0] + 6;
        $x6 = str_pad($x6, 2, '0', STR_PAD_LEFT);
    }
}

$k = ''
        . '$("pre i:contains(' . $x . ')").css("background", "red");'
        . '$("pre i:contains(' . $x0 . ')").css("background", "#ccb89d");'
        . '$("pre i:contains(' . $x1 . ')").css("background", "#5cb85c");'
        . '$("pre i:contains(' . $x2 . ')").css("background", "#5cb85c");'
        . '$("pre i:contains(' . $x3 . ')").css("background", "#5cb85c");'
        . '$("pre i:contains(' . $x4 . ')").css("background", "#5cb85c");'
        . '$("pre i:contains(' . $x5 . ')").css("background", "#5cb85c");'
        . '$("pre i:contains(' . $x6 . ')").css("background", "#5cb85c");'
        . '';
$this->registerJs($k);
