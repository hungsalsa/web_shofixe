<?php

namespace frontend\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use frontend\models\Product;
use backend\modules\quantri\models\Producttype;

class testimonialAreaWidget extends Widget
{
    public $message;

    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
       return $this->render('testimonialAreaWidget');
    }
}
