<?php 
namespace nill\comment_widget;

use yii\base\Widget;
use vova07\blogs\models\frontend\Blog;

class Widget_cc extends Widget
{
    public $limit;
    public $customers;

    public function init()
    {
        parent::init();
        
    }

    public function getNews($limit){

        $this->customers = Blog::find()->published()
            ->limit($limit)
            ->orderBy(['id'=>SORT_DESC])
            ->asArray()
            ->all();
    }
    
    public function run()
    {
        return $this->render('cc',[
            'news'=>$this->customers,
        ]);
    }
}