<?php

namespace backend\controllers;

class FilemanagerController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}