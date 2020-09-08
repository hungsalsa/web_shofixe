<?php

namespace backend\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use backend\modules\khachhang\models\KhDichvu;
use backend\modules\sanpham\models\ProductTransfer;
use backend\modules\quantri\models\CuaHang;

class navbarWidget extends Widget
{
    public $message;

    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
    	$user = Yii::$app->user->identity;
        $message='';
        $checkmess = false;
        
        // Lấy danh sách cửa hàng theo User login
		$tkkhach = new CuaHang();
        $dataCuahang = $tkkhach->getAllCuahang();
        // $cuahang_id = array_keys($tkkhach->getCuahang_ByUser());
        $cuahang_id = json_decode(getUser()->cuahang_id);
        $data =[];
 
        $tkkhach = new ProductTransfer();
        if (getUser()->manager == false) {
            $message = 'Bạn có :';
            $data = $tkkhach->getTransferTo();
            // Yii::$app->session->setFlash('messeage',$data['message']);
        }else {
            $message = 'Có tất cả : <br>';
            // dbg($countden = $tkkhach->getTranfer_Status_den([],$cuahang_id,[0,1]));
            if ($data['total'] = $tkkhach->getTranfer_Status_den([],$cuahang_id,[0,1]) > 0) { 
                // $data['total'] = $countStatus;
                $message .= $data['total'].' phiếu chuyển hàng chưa chấp nhận<br>';
                $checkmess= true;
                Yii::$app->session->setFlash('messeage',$message);
            }
        }

		$tkkhach = new KhDichvu();
        $dataDichvu = $tkkhach->getKHdv_status($cuahang_id);
        if ($dataDichvu) {
        	$message .= count($dataDichvu).' phiếu dịch vụ chưa xuất';
            $data['dichvu'] = count($dataDichvu);
        	$checkmess= true;
        }
        if ($checkmess){
            if (Yii::$app->user->getId() == 1 && Yii::$app->controller->id =='site') {
            	Yii::$app->session->setFlash('messeage',$message);
            }

            if (Yii::$app->user->getId() != 1) {
                Yii::$app->session->setFlash('messeage',$message);
            }
        }

        $userAssigned = Yii::$app->authManager->getAssignments(Yii::$app->user->id);
        $userAssigned = reset($userAssigned);
        $roleName = $userAssigned->roleName;

        // $userAssigned = Yii::$app->authManager->getAssignments(Yii::$app->user->getId());

        // foreach($userAssigned as $userAssign){
        //     $roleName = $userAssign->roleName;
        // }

        return $this->render('navbarWidget',['data'=>$data,'roleName'=>$roleName]);
    }
}
