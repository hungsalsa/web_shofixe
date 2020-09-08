<?php

namespace backend\modules\sanpham\controllers;
use Yii;
use backend\modules\sanpham\models\Inma;
use backend\modules\sanpham\models\Product;
use backend\modules\sanpham\models\ProductImport;
use backend\modules\doanhthu\models\CuaHang;

// use backend\modules\doanhthu\models\OrderDetail;
// use backend\modules\doanhthu\models\Order;

use yii\widgets\ActiveForm;
class InmaController extends \yii\web\Controller
{
    public function actionIndex()
    {
       $searchModel = new Inma();
        $user = Yii::$app->user->identity;

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

    	$product = new Product();
    	$dataPro = $product->getAllProduct();

    	// echo '<pre>';print_r($dataPro);
    	// die;
    	$soluong =0;
    	$dataProQuery = [];
        
        if (Yii::$app->request->isAjax && $searchModel->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($searchModel);
        }

    	if ($searchModel->load($post = Yii::$app->request->post()))
        {
          $cuahang_id = $post['Inma']['cuahang_id'];
          $idPro = $post['Inma']['idPro'];

      	 $soluong = $product->getSoluong($idPro,$cuahang_id);
      	 $dataProQuery = $product->getProInfo($idPro,$cuahang_id);
          
        }


        return $this->render('index', [
            'cuahang' => $cuahangs,
            'searchModel' => $searchModel,
            'dataPro' => $dataPro,
            'soluong' => $soluong,
            'dataProQuery' => $dataProQuery,
        ]);
    }


    public function actionCapnhatxuat($status = true){
        $data = Product::find()->alias('pro')
        // ->select(['CONCAT(idPro,"-",proName,"-",price,"-",cu.name,"-slg: ",quantity) AS nameCon','pro.id AS masp','cu.name'])
        ->select(['idPro','pro.id AS masp','ch.name AS tenCH','dt.pro_id AS MAspxuat','dt.order_id'])

        ->innerJoinWith('cuahang ch',false)
        // ->innerJoinWith('order od',false)
        ->innerJoinWith('orderdetail dt',false)
        ->asArray()
        ->andWhere('pro.status =:Status',[':Status'=>$status])
        ->orderBy(['ch.name'=>SORT_ASC, 'dt.order_id'=>SORT_ASC ])->all();

        // foreach ($data as $value) {
        //     $connection = Yii::$app->db;
        //     $command = $connection->createCommand('CALL update_detail_order('.$value["order_id"].',"'.$value["idPro"].'")');     
        //     $command->execute();

        // }
        echo '<pre>';
        print_r($data);
        die;
    }

    public function actionCapnhatnhap($status = true){
        $data = Product::find()->alias('pro')
        // ->select(['CONCAT(idPro,"-",proName,"-",price,"-",cu.name,"-slg: ",quantity) AS nameCon','pro.id AS masp','cu.name'])
        ->select(['nh.date','ctn.import_id','nh.cuahang_id','ctn.pro_id as maspnhap','pro.id AS masp','ch.name AS tench'])
        // ->select(['nh.date','ch.name','imd.pro_id','pro.id'])
        // ->select(['idPro','pro.id','od.name AS tenCH','dt.pro_id','dt.order_id'])

        ->innerJoinWith('nhaphang nh',false)
        ->innerJoinWith('chitietnhap ctn',false)
        ->innerJoinWith('cuahang ch',false)
        // ->innerJoinWith('sanpham sp',false)
        ->asArray()
        // ->andWhere('pro.status =:Status',[':Status'=>$status])
        ->orderBy(['ctn.import_id'=>SORT_ASC,'nh.cuahang_id'=>SORT_ASC])->all();

        // Goij thur tucj de thuc thi sua
        foreach ($data as $value) {
            $connection = Yii::$app->db;
            $command = $connection->createCommand('CALL update_import_detail("'.$value["maspnhap"].'",'.$value["import_id"].','.$value["cuahang_id"].')');     
            $command->execute();

        }
        echo '<pre>';
        print_r($data);
        die;
    }


    public function actionThemsophieu()
    {
        $connection = Yii::$app->db;
        $command = $connection->createCommand('CALL ThemPhieu("2018/12/15",10,20,1)');     
        $command->execute();
    }

}
