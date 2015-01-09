<?php

namespace nill\comment_widget;

use yii\base\Widget;
use app\modules\video\models\CommentsClock;
use Yii;
use app\modules\video\models\Video;

class Widget_cc extends Widget {

    public $limit;
    public $customers;

    public function init() {
        parent::init();
    }

    public function run() {
        $comments_clock_model = new CommentsClock();
        $comments_clock = $comments_clock_model->find()->where(['author_id' => Yii::$app->user->id])->asArray()->all();
        $comments_clock_count = $comments_clock_model->find()->where(['author_id' => Yii::$app->user->id])->count();
        
        return $this->render('comment_clock', [
                    'cc' => $comments_clock,
                    'cc_count' => $comments_clock_count,
        ]);
    }

    public static function getVideo($id) {
        return Video::findOne(['id' => $id]);
    }
}
