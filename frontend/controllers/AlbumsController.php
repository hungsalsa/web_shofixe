<?php

namespace frontend\controllers;

class AlbumsController extends \yii\web\Controller
{
    public function actionIndex()
    {
		$this->layout = 'albums';
        return $this->render('index');
    }

    public function actionDetail()
    {
		$this->layout = 'albums';
        return $this->render('index');
    }

}
