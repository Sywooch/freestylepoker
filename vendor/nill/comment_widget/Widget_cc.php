<?php

namespace nill\comment_widget;

use yii\base\Widget;
use nill\comment_widget\models\CommentsClock;
use Yii;

class Widget_cc extends Widget {

    public $limit;
    public $customers;

    public function init() {
        parent::init();
    }

    public function run() {
        $comments_clock_model = new CommentsClock();
        $comments_clock = $comments_clock_model->_model;
        $comments_clock_count = $comments_clock_model->_count;
        
        return $this->render('comment_clock', [
                    'cc' => $comments_clock,
                    'cc_count' => $comments_clock_count,
        ]);
    }
}
