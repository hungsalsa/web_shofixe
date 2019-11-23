<?php
namespace app\components;

use app\modules\setting\models\FSetting;
class MyGlobalClass extends \yii\base\Component{
    public function init() {
       $setting = new FSetting();
        $setting->getSetting();
        parent::init();
    }
}