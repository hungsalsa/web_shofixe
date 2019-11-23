<?php

namespace backend\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;

class navbarWidget extends Widget
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
         return $this->render('navbarWidget',['roleName'=>$roleName]);
    }
}