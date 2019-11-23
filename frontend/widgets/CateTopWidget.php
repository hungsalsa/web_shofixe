<?php

namespace frontend\widgets;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use app\modules\quantri\models\FNews;

class CateTopWidget extends Widget
{
    public $message;

    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
        $new = new FNews();
        $news_hot = $new->getNewsHots();
       return $this->render('CateTopWidget',['news_hot'=>$news_hot]);
    }
}
