<?php

namespace backend\modules\common\controllers;

use yii\web\Controller;
use backend\modules\phieu\models\PhieuSophieu;
use backend\modules\khachhang\models\KhDichvu;

/**
 * Default controller for the `common` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
    	// Cập nhật lại số phiếu các phiếu dịch vụ của các cửa hàng
    	// echo '<pre>';
    	// $dichvu = KhDichvu::find()->where(['cuahang_id'=>5])->all();
    	// foreach ($dichvu as $kh_dv) {
    	// 	// print_r($kh_dv);die;
    	// 	if ($id_phieu = $this->getIdPhieu($kh_dv->cuahang_id,$kh_dv->sophieu)) {
    	// 		$kh_dv->sophieu = $id_phieu;
    	// 		$kh_dv->save();
    	// 	}
    	// }
    	// print_r($dichvu);
    	// die;
        return $this->render('index');
    }

    private function getIdPhieu($cuahang_id,$so_phieu)
    {
    	$data = PhieuSophieu::find()->select(['id'])->where(['cuahang_id'=>$cuahang_id,'so_phieu'=>$so_phieu])->asArray()->one();
    	return $data['id'];
    }
}
