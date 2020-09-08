<?php

namespace backend\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class sidebarWidget extends Widget
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
        
        // foreach($userAssigned as $userAssign){
        //     $roleName = $userAssign->roleName;
        // }
    	// echo '<pre>';print_r($userAssigned);die;
    	return $this->render('sidebarWidget',['roleName'=>$roleName]);
    }
}