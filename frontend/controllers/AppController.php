<?php    
namespace frontend\controllers;
use Yii;

    class AppController extends \yii\web\Controller
    {
        public function init(){
            parent::init();

        }
        public function Setting(){
            return "Hello Yii2";
        }
    }