<?php
namespace console\controllers;
use yii\console\Controller;
 
Class MakefileController extends Controller
{
    public function actionMake(){
        // root of directory yii2
        // /var/www/html/<yii2>
        $rootyii = realpath(dirname(__FILE__).'/../../');
 
        // create file <hour:minutes:second>.txt

        $filename = date('H-i-s') . '.txt';
        // $fp = fopen(\Yii::getAlias('@frontend')."/web/cronjob/".$filename,"w+");
        $folder = $rootyii.'/cronjob/'.$filename;

        $f = fopen($folder, 'w+');
        // $fw = fwrite($fp, 'now : ' . $filename);
        $fw = fwrite($f, 'now : ' . $filename);
        fclose($f);
    }
}