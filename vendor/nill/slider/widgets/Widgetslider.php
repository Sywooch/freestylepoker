<?php 
namespace nill\slider\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use nill\slider\models\Slider as Slider;

/*
* This widget is used to insert the slider 
* in the view page
*/  
class Widgetslider extends Widget
{
    public $status;
    public $slider;

    public function init()
    {
        parent::init();
        if ($this->status === null || $this->status === 'on') {
            $this->status = true;
        }
        else {
            $this->status = false;
        }
        $this->slider=Slider::getSliders();
    }

    public function run()
    {
        return $this->render('slider',[
            'slider'=>$this->slider,
            'status'=>$this->status,
        ]);
    }
}