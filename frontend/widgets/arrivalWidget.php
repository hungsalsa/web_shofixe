<?php

namespace frontend\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use frontend\modules\quantri\models\Product;
use frontend\modules\quantri\models\ProductType;

class arrivalWidget extends Widget
{
    public $message;

    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
    	$model = new ProductType();
    	$type = ['mới','phổ biến','bán chạy'];
    	$product_type_id = $model->getIdList($type);
    	$dataProType = $model->getAllType();
    	

    	$model = new Product();
    	$idPro = $model->getProductByType($product_type_id);

    	$product = Product::findAll($idPro);
    	// echo '<pre>';print_r($product);
    	// die;

       return $this->render('arrivalWidget',['product'=>$product,'dataProType'=>$dataProType]);
    }
}
