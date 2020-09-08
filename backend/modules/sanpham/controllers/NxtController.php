<?php

namespace backend\modules\sanpham\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\NotAcceptableHttpException;
use backend\modules\sanpham\models\ThongkeSearch;
use backend\modules\sanpham\models\Inma;
use backend\modules\sanpham\models\Product;
use backend\modules\sanpham\models\ProductCate;
use backend\modules\quantri\models\CuaHang;
use backend\modules\chi\models\Chitietchi;
use backend\modules\chi\models\ChiKhoanchi;
use backend\modules\chi\models\Chingay;
use backend\modules\sanpham\models\Thongkesp;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
class NxtController extends \yii\web\Controller
{
	/*public function actionIndex()
	{
		$searchModel = new ThongkeSearch();
		$user = Yii::$app->user->identity;

		$cate = new ProductCate();
		$dataCate_query = $dataCate = $cate->getCategoryParent();

		$cuahang = new CuaHang();
		$cuahang_query = $cuahangs = $cuahang->getCuahang_ByUser();
		if($user->manager != 1){
			$list = json_decode($user->cuahang_id);

			foreach ($cuahang as $key => $value) {
				if(!in_array($key, $list)){
					unset($cuahang[$key]);
				}
			}
		}

		$product = new Product();
		$dataPro = $product->getProductThongke();

		$neTK = new Thongkesp();
		$listProduct = ArrayHelper::map($neTK->getAllProInSearch([2]),'masp','tensp');

      // echo '<pre>';print_r($dataPro);
      // die;
		if ($searchModel->load($post = Yii::$app->request->post()))
		{
			$cuahang_id = $post['ThongkeSearch']['cuahang_id'];
			$cate_id = $post['ThongkeSearch']['cate_id'];
			$proId = $post['ThongkeSearch']['proId'];

			if($cate_id !='')
			{
				$idList = $cate->getAllIDCate($cate_id);
				foreach ($dataCate_query as $key => $value) {
					if(!in_array($key,$idList)){
						unset($dataCate_query[$key]);
					}
				}
			}

			if($cuahang_id !='')
			{
				$cuahang_query = [$cuahang_id=>$cuahangs[$cuahang_id]];
			}

			

			$dataPro = $product->getProductThongke($cuahang_id,$cate_id,$proId);

		}

		// $chitiet = new Chitietchi();
		// $datactt = $chitiet->Total_number_Money(1);
		// // $datactt = $chitiet->Total_number_Money(2);

		// $data = new ChiKhoanchi();
  //       $dataKhoanchi = ArrayHelper::map($data->KhoanchiLe([1]),'id','id');

		// echo '<pre>';
		// print_r($datactt);
		// // print_r($dataKhoanchi);
		// die;


		return $this->render('index', [
			'dataCate' => $dataCate,
			'dataCate_query' => $dataCate_query,
			'cuahang' => $cuahangs,
			'cuahang_query' => $cuahang_query,
			'searchModel' => $searchModel,
			'data' => $dataPro,
			'listProduct' => $listProduct,
		]);
	}*/

	public function actionView($id)
	{
		$dataPro = Product::findOne($id);

		$dataCuahang = ArrayHelper::map(CuaHang::findAll(['status'=>true]),'id','name');
		$data = new Chitietchi();
		// print_r($dataPro->cuahang_id);die;
		$dataChitiet = $data->AllChi($dataPro->idPro,$dataPro->cuahang_id);
		// $dataNgaychi = Chitietchi::findOne()
		// $allKhoanchi = Chitietchi::findAll(['name'=>$idKC->id]);
		// $data = new Chingay();
		$dataNgay = $data->AllDay($dataPro->idPro,$dataPro->cuahang_id);
		echo '<pre>';
		print_r($dataChitiet);
		// print_r($dataPro);
		die;
		return $this->render('view',[
			'dataPro'=>$dataPro,
			'dataCuahang'=>$dataCuahang,
			'dataChitiet'=>$dataChitiet,
			'dataNgay'=>$dataNgay,
		]);
	}

	public function actionIndex()
	{
		$thongke = new Thongkesp();
		$dataPro = $thongke->getThongKe();
		// $product = $data->getAllProInSearch([2]);
		$listProduct = ArrayHelper::map($thongke->getAllProInSearch([2]),'idPro','tensp');
		// $dataPro = ArrayHelper::map($data->getProductThongke(2),');
		
		$searchModel = new ThongkeSearch();
		$user = Yii::$app->user->identity;

		$cate = new ProductCate();
		$dataCate_query = $dataCate = $cate->getCategoryParent();

		$cuahang = new CuaHang();
		$cuahang_query = $cuahangs = $cuahang->getCuahang_ByUser();
		if($user->manager != 1){
			$list = json_decode($user->cuahang_id);

			foreach ($cuahang as $key => $value) {
				if(!in_array($key, $list)){
					unset($cuahang[$key]);
				}
			}
		}

		if ($searchModel->load($post = Yii::$app->request->post()))
		{
			$cuahang_id = $post['ThongkeSearch']['cuahang_id'];
			$cate_id = $post['ThongkeSearch']['cate_id'];
			$proId = $post['ThongkeSearch']['proId'];

			if($cate_id !='')
			{
				$idList = $thongke->getAllIDCate($cate_id);
				foreach ($dataCate_query as $key => $value) {
					if(!in_array($key,$idList)){
						unset($dataCate_query[$key]);
					}
				}
			}

			if($cuahang_id !='')
			{
				$cuahang_query = [$cuahang_id=>$cuahangs[$cuahang_id]];
			}

			// $dataPro = $thongke->getThongKe($cuahang_id,$cate_id,$proId);

		}
// $dataPro = $thongke->getAllIDCate(1);
// echo '<pre>';
// 		print_r($cuahang_id);
// 		print_r($proId);
// 		print_r($cate_id);
// 		print_r($dataCate_query);
		// print_r($idList);
		// die;

		// $product = new Product();
		// $dataPro = $product->getProductThongke();
		return $this->render('index',[
			'dataCate' => $dataCate,
			'dataCate_query' => $dataCate_query,
			'cuahang' => $cuahangs,
			'cuahang_query' => $cuahang_query,
			'searchModel' => $searchModel,
			'dataPro' => $dataPro,
			'listProduct' => $listProduct,
		]);
	}

}
