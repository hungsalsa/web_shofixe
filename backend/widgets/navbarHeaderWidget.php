<?php

namespace backend\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;
// use backend\modules\quanlytin\models\Categories;
// use backend\modules\setting\models\Menus;

class navbarHeaderWidget extends Widget
{
    public $message;

    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
    	$userAssigned = Yii::$app->authManager->getAssignments(Yii::$app->user->id);
        $userAssigned = reset($userAssigned);
        $roleName = $userAssigned->roleName;
    	// dbg($roleName);
         return $this->render('navbarHeaderWidget',['roleName'=>$roleName]);
    }
}
