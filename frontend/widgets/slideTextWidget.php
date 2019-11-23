<?php

namespace frontend\widgets;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use app\modules\quantri\models\FNews;

class slideTextWidget extends Widget
{
    public $message;

    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
        $new = new FNews();
        $news_hot_2 = $new->getNewsHots([2]);
        // dbg($news_hot_2);
       return $this->render('slideTextWidget',['news_hot_2'=>$news_hot_2]);
    }
}
