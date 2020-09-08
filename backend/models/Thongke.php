<?php
namespace backend\models;

use Yii;
use backend\modules\khachhang\models\KhDichvu;
use backend\modules\sanpham\models\Order;
use backend\modules\khachhang\models\KhachHang;
use backend\models\User;
use yii\helpers\ArrayHelper;
class Thongke extends \yii\db\ActiveRecord
{
	public function getCount()
	{
		$dataCount = [];
		
		$dataCount = $this->getCountServices();


 		$yesterday = date('Y/m/d', strtotime('-1 day', strtotime(date("Y/m/d"))));
 		$today = date("Y/m/d");

		$user_add = [1,2,7,8,9,10,12];
		$dataCount['key_user'] = $user_add;
		$dataCount['user'] = ArrayHelper::map(User::findAll($user_add),'id','fullname');
		foreach ($user_add as $value) {
			// Tinhs tong khach hang cua cac user da them ngay hom qua theo tung user
			$khachhang = $this->Customer($value);
			foreach ($khachhang as $keykh => $valuekh) {
				if (date('Y/m/d',$valuekh->created_at) != $yesterday) {
					unset($khachhang[$keykh]);
				}
			}
			$dataCount['khachhang']['yesterday'][$value] = count($khachhang);
			
			// Tinh tong so khach hangf da them ngay hom nay theo tung user
			$khachhang = $this->Customer($value);
			foreach ($khachhang as $keykh => $valuekh) {
				if (date('Y/m/d',$valuekh->created_at) != $today) {
					unset($khachhang[$keykh]);
				}
			}
			$dataCount['khachhang']['today'][$value] = count($khachhang);
			
			// Tinh tong tat ca cac khach hang da them theo tung user
			$dataCount['khachhang'][$value] = count($this->Customer($value));
		}
		// $dataCount['khachhang']['today'] = $this->countCustomer();
		
		// echo '<pre>';print_r($dataCount);
		// die;

		return $dataCount;
	}


	private function Customer($user_add='')
	{
		$data = KhachHang::find();
		if ($user_add !='') {
			$data->andWhere(['user_add'=>$user_add]);
		}
		return $data->orderBy(['created_at' => SORT_DESC])->all();
	}

	private function getCountServices($user_add='')
    {
        $data = $this->getServices();

        $yesterday = date('Y/m/d', strtotime('-1 day', strtotime(date("Y/m/d"))));
 		$today = date("Y/m/d");
 		$user_add = [1,2,7,8,9,10,12];
 		foreach ($user_add as $value) {
			// Tinhs tong khach hang cua cac user da them ngay hom qua theo tung user
			$khdichvu = $this->getServices($value);
			foreach ($khdichvu as $keykh => $valuekh) {
				if (date('Y/m/d',$valuekh->created_at) != $yesterday) {
					unset($khdichvu[$keykh]);
				}
			}
			$dataCount['khdichvu']['yesterday'][$value] = count($khdichvu);
			
			// Tinh tong so khach hangf da them ngay hom nay theo tung user
			$khdichvu = $this->getServices($value);
			foreach ($khdichvu as $keykh => $valuekh) {
				if (date('Y/m/d',$valuekh->created_at) != $today) {
					unset($khdichvu[$keykh]);
				}
			}
			$dataCount['khdichvu']['today'][$value] = count($khdichvu);
			
			// Tinh tong tat ca cac khach hang da them theo tung user
			$dataCount['khdichvu'][$value] = count($this->getServices($value));
		}

		return $dataCount;
    }

    private function getServices($user_add='')
    {
        $data = KhDichvu::find();
        if ($user_add !='') {
			$data->andWhere(['user_add'=>$user_add]);
		}
		return $data->orderBy(['created_at' => SORT_DESC])->all();
    }
}