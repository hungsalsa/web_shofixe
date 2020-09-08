<?php

namespace backend\modules\common\models;

use Yii;
use yii\helpers\ArrayHelper;
use backend\modules\khachhang\models\KhDichvu;

class Tkkhachhang extends \yii\db\ActiveRecord
{
    /*HÀM LẤY DANH SÁCH CÁC ĐƠN HÀNG CHƯA CẬP NHẬT*/
    public function getKHdv_status()
    {
        return KhDichvu::find()->alias('dv')
            // ->joinWith(['chitietdv ct'],true)
            // ->where('dv.status=:active',[':active'=>0])
            ->asArray()->orderBy(['dv.cuahang_id'=>SORT_ASC,'dv.status'=>SORT_ASC])->all();
    }

}
