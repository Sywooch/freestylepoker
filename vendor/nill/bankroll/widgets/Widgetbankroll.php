<?php

namespace nill\bankroll\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use nill\bankroll\models\Bankroll;

/*
 * This widget is used to insert the bankroll 
 * in the view page
 */

class Widgetbankroll extends Widget {

    public $status;
    public $bankroll;

    public function init() {
        parent::init();
        if ($this->status === null || $this->status === 'on') {
            $this->status = true;
        } else {
            $this->status = false;
        }
        $this->bankroll=Bankroll::getBlocks();
    }

    public function run() {
        return $this->render('bankroll', [
                    'bankroll' => $this->bankroll,
                    'status' => $this->status,
        ]);
    }

}
