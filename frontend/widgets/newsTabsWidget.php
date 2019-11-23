<?php

namespace frontend\widgets;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use app\modules\quantri\models\FNews;
use app\modules\quantri\models\FVideos;

class newsTabsWidget extends Widget
{
    public $message;

    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
        $new = new FNews();
        $video = new FVideos();
        // $news_hot = $new->News_Update();
        $data = [
            'latestNews'=>$new->latestNews(10),
            'MostViewedNews'=>$new->MostViewedNews(10),
            'Videos'=>$video->getVideos(5),
        ];
        // $news_hot = $new->getNewsHots();
        // dbg($data['Videos']);
       return $this->render('newsTabsWidget',['data'=>$data]);
    }
}
