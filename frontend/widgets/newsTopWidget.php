<?php

namespace frontend\widgets;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use app\modules\quantri\models\FNews;

class newsTopWidget extends Widget
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
// foreach ($news_hot as $value) {
//     pr($value->hotposition);
// }
        // dbg($news_hot);
       return $this->render('newsTopWidget',['news_hot'=>$news_hot]);
    }
}
