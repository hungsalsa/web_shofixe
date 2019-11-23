<?php

namespace frontend\widgets;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use app\modules\setting\models\SettingModules;

class cateNewsWidget extends Widget
{
    public $message;

    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
        $cateSetting = new SettingModules();
        $cateSetting = $cateSetting->getAllCategoryHome();
        
        // dbg($cateSetting);
       return $this->render('cateNewsWidget',['cateSetting'=>$cateSetting]);
    }
}
