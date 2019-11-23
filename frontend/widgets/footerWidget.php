<?php

namespace frontend\widgets;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use frontend\modules\quantri\models\Categories;
use frontend\modules\quantri\models\FNews;
use frontend\modules\setting\models\FSetting;
// use frontend\modules\quantri\models\ProductType;

class footerWidget extends Widget
{
    public $message;

    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
    	
    	/*$cate = Categories::findAll(['status'=>true]);

        $model = new Categories();
        $dataCate = $model->find()->where(['status'=>true,'parent_id'=>0])->orderBy(['sort'=>SORT_ASC,'cateName'=>SORT_ASC])->all();

        $model = new FNews();
        $dataNew = $model->find()->where(['status'=> true])->orderBy(['rand()' => SORT_DESC])->limit(4)->all();

        // Kieemr tra xem co cache setting chua
        // dbg($settings = Yii::$app->cache->get('settings_app_website'));
        if (Yii::$app->cache->get('settings_app_website')=== false) {
            $model = new FSetting();
            $model->getLogo();
        };
        $settings = Yii::$app->cache->get('settings_app_website');*/
       return $this->render('footerWidget'/*,['dataCate'=>$dataCate,'dataNew'=>$dataNew,'settings'=>$settings]*/);
    }
}
