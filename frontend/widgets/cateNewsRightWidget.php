<?php

namespace frontend\widgets;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use app\modules\setting\models\SettingModules;

class cateNewsRightWidget extends Widget
{
    public $message;

    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
        $cateSetting = new SettingModules();
        $cateSetting = $cateSetting->getAllCategoryHome([1]);
        
        // dbg($cateSetting);
       return $this->render('cateNewsRightWidget',['cateSetting'=>$cateSetting]);
    }
}
