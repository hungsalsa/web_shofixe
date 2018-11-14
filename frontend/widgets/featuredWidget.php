<?php

namespace frontend\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use frontend\modules\quantri\models\Product;
use frontend\modules\quantri\models\ProductCategory;
use frontend\modules\setting\models\SettingCategoryHome;
use frontend\modules\setting\models\SettingDisplayProductType;
use frontend\modules\quantri\models\ProductType;

class featuredWidget extends Widget
{
    public $message;

    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
    	$data = SettingCategoryHome::findOne(['status' => true,'location'=>1]);

    	// Lay Id cate setting
    	$idCate = $data->category_id;
    	$data = new ProductCategory();
    	// tra ve cac con cua idCate
    	$idCateList  = $data->getAllChild($idCate);
    	// Lay tat ca cac san pham co id_cate nam trong idCate

    	$data = new Product();
    	$data = $data->getAllProductByIdCate($idCateList);

    	$model = new SettingDisplayProductType();
    	$dataProType = $model->getAllProType($idCate);

    	unset($idCate,$model,$idCateList);
    	// echo '<pre>';print_r($dataProType);die;
       return $this->render('featuredWidget',['products'=>$data,'dataProType'=>$dataProType]);
    }
}
