<?php
namespace app\models;
class Mydatetime extends \yii\db\ActiveRecord 
{
	function sw_get_current_weekday($weekday,$timestamp,$active=true) {
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		// $weekday = date("l");
		// dbg($weekday);
		$weekday = strtolower($weekday);
		switch($weekday) {
			case 'monday':
			$weekday = 'Thứ hai';
			break;
			case 'tuesday':
			$weekday = 'Thứ ba';
			break;
			case 'wednesday':
			$weekday = 'Thứ tư';
			break;
			case 'thursday':
			$weekday = 'Thứ năm';
			break;
			case 'friday':
			$weekday = 'Thứ sáu';
			break;
			case 'saturday':
			$weekday = 'Thứ bảy';
			break;
			default:
			$weekday = 'Chủ nhật';
			break;
		}
		if ($active==true) {
			return $weekday.', '.date('d/m/Y H:i',$timestamp);
		}else {
			return date('d/m/Y H:i',$timestamp);
		}
	}
}