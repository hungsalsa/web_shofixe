<?php

namespace backend\modules\doanhthu\controllers;

use yii\web\Controller;
use Yii;
use backend\modules\doanhthu\models\CuaHang;
use backend\modules\doanhthu\models\ThongkeSearch;
use yii\widgets\ActiveForm;
/**
 * Default controller for the `doanhthu` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
       
      $user = Yii::$app->user->identity;
      
      $loaichi = new CostType();
      $loaichis = $loaichi->getAllCosttype();

      $cuahang = new CuaHang();
      $cuahangs = $cuahang->getCuahangByID();
      $cuahang_query = $cuahang->getCuahangByID();
      if($user->manager != 1){
            $list = json_decode($user->cuahang_id);
           
            foreach ($cuahang as $key => $value) {
                if(!in_array($key, $list)){
                    unset($cuahang[$key]);
                }
            }
        }

        $chingay = new Chingay();
        $cuahang_id = '';
        $start_date = date("Y-m-01");
        $end_date = date("Y-m-d");

        
        $datachi = $chingay->getAllChiByMonth();

        if ($searchModel->load($get = Yii::$app->request->post()))
        {
          $cuahang_id = $get['ThongkeSearch']['cuahang_id'];
          $start_date = $get['ThongkeSearch']['start_date'];
          $end_date = $get['ThongkeSearch']['end_date'];
          
          if($cuahang_id !=''){
            $cuahang_query = [$cuahang_id=>$cuahangs[$cuahang_id]];
          }

          if($start_date !=''){
            $start_date = date('Y-m-d',strtotime($start_date));
          }else {
            $start_date = date("Y-m-01");
          }

          if($end_date !=''){
            $end_date = date('Y-m-d',strtotime($end_date));
          }else {
            $end_date = date("Y-m-d");
          }
          

          $datachi = $chingay->getAllChiByMonth($cuahang_id,$start_date,$end_date);
          
        }
        // print_r($start_date);
        // print_r($end_date);
        // die;
        return $this->render('index', [
            'loaichis' => $loaichis,
            'cuahang' => $cuahangs,
            'cuahang_query' => $cuahang_query,
            'searchModel' => $searchModel,
            'data' => $datachi,
        ]);
    }
}
