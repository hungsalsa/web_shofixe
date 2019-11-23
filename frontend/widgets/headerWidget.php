<?php

namespace frontend\widgets;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use app\modules\setting\models\Banner;
use app\modules\setting\models\FMenus;
use app\models\Mydatetime;
use app\modules\setting\models\FSetting;

class headerWidget extends Widget
{
    public $message;

    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
        $banner = new Banner();
        $date = new Mydatetime();
        
        $datetimenow=$date->sw_get_current_weekday(getdate()['weekday'],time());
        $cache = Yii::$app->cache;
        $data = [];
        // dbg($cache->get('settings_app_website'));
        // if ($cache->get('app_cache_header') === false) {
        $banner = $banner->getBanner();
        $menu = new FMenus();
            $dataMenu = $menu->MenuHome();
            foreach ($dataMenu as $key => $value) {
                $dataMenu[$key]['dataSubmenu'] = $menu->MenuHome($value['id']);
            }
            // dbg($dataMenu);
            $datetime= date('Y-m-d H:i:s');
            $header = [
                
                'banner'=>[
                    'content'=>$banner->content,
                    'content_mobile'=>$banner->content_mobile,
                ],
                'dataMenu'=>$dataMenu,
            ];
            $data = $header;
        
            Yii::$app->cache->set('app_cache_header', $header, 21600);//set cache trong 6 tieng
        // }
        // $app_cache_header = $cache->get('app_cache_header');
        // echo 'header';
// pr($data);
        // dbg();
       return $this->render('headerWidget',['datetimenow'=>$datetimenow]);
    }
}
