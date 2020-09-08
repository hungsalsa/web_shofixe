<?php

namespace backend\modules\sanpham\models;

use Yii;
use yii\helpers\ArrayHelper;
use backend\modules\chi\models\Chitietchi;
use backend\modules\chi\models\Chitietchikhac;
use backend\modules\chi\models\ChiKhoanchi;
use backend\modules\sanpham\models\Product;
use backend\modules\sanpham\models\ProductTransferDetail;
use backend\modules\khachhang\models\KhChitietDv;
use yii\db\Expression;

class Thongkesp extends \yii\db\ActiveRecord
{
    /*HÀM LẤY DANH TỔNG CÁC PHỤ TÙNG XUẤT CHO KHÁCH*/
    public function getProduct_KH($idPro,$cuahang_id)
    {
        return $data = KhChitietDv::find()->alias('ct')
        ->select(['SUM(ct.quantity) AS tongslban', 'sum([[ct.quantity]] * [[ct.price]]) AS tongtienban','ds.madichvu','ds.tendv'])
        ->joinWith(['dichvu dv','danhsachdv ds'],false)
        ->where(['ds.madichvu'=>$idPro,'ds.phutung'=>1,'dv.status'=>true])
        ->andWhere(['in','dv.cuahang_id',$cuahang_id])
        ->groupBy(['ds.madichvu'])
        ->asArray()
        ->one();
    }

       /*HÀM LẤY DANH TỔNG CÁC PHỤ TÙNG XUẤT NỘI BỘ*/
    private function getProduct_XuatNB($idPro,$cuahang_id)
    {
        return $data = ProductTransferDetail::find()->alias('ct')
        ->select(['SUM(ct.quantity) AS tongslchuyen','sp.idPro','sp.proName'])
        ->joinWith(['chuyenkho ck','sanpham sp'],false)
        ->where(['sp.idPro'=>$idPro,'ck.status'=>2])
        ->andWhere(['in','sp.cuahang_id',$cuahang_id])
        ->andWhere(['in','ck.cuahang_id',$cuahang_id])
        ->groupBy(['sp.idPro'])
        ->asArray()
        ->one();
    }

       /*HÀM LẤY DANH TỔNG CÁC PHỤ TÙNG NHẬP NỘI BỘ*/
    public function getProduct_NhapNB($idPro,$cuahang_id)
    {
        return $data = ProductTransferDetail::find()->alias('ct')
        ->select(['SUM(ct.quantity) AS tongslchuyen','sp.idPro','sp.proName','ck.chuyenden_cuahang'])
        ->joinWith(['chuyenkho ck','sanpham sp'],false)
        ->where(['sp.idPro'=>$idPro,'ck.status'=>2])
        // ->andWhere(['in','sp.cuahang_id',$cuahang_id])
        ->andWhere(['in','ck.chuyenden_cuahang',$cuahang_id])
        ->groupBy(['sp.idPro'])
        ->asArray()
        ->one();
    }

    /*Tính tổng phụ tùng lẻ*/
    private function getProduct_Total_Nhap($idPro,$cuahang_id)
    {
        return $data = Chitietchi::find()->alias('ct')
        // ->select([new Expression('SUM(quantity) as TongSL')])
        ->select(['SUM(quantity) AS tongslnhap', 'sum([[quantity]] * [[money]]) AS tongtiennhap'])
        // ->indexBy('cn')
        ->joinWith(['chingay cn','khoanchi kc'],false)
        ->where(['kc.makhoanchi'=>$idPro,'loaichi_id'=>1,'cn.status'=>true])
        ->andWhere(['in','cn.cuahang_id',$cuahang_id])
        ->asArray()->orderBy(['cn.day' => SORT_ASC])->one();
    }
    /*Tính tổng phụ tùng Toa*/
    private function getProduct_Total_NhapToa($idPro,$cuahang_id)
    {
        return $data = Chitietchikhac::find()->alias('ct')
        // ->select([new Expression('SUM(quantity) as TongSL')])
        ->select(['SUM(quantity) AS tongslnhap', 'sum([[quantity]] * [[money]]) AS tongtiennhap'])
        // ->indexBy('cn')
        ->joinWith(['chingaykhac cn','khoanchi kc'],false)
        ->where(['kc.makhoanchi'=>$idPro,'loaichi_id'=>2,'cn.status'=>true])
        ->andWhere(['in','cn.cuahang_id',$cuahang_id])
        ->asArray()->orderBy(['cn.day' => SORT_ASC])->one();
    }

    public function getThongKe($cuahang_id = '',$cate_id = [],$idPro='')
    {
        $product = $this->getProductThongke($cuahang_id,$cate_id,$idPro);
        // $dataPro
        foreach ($product as $key=> $value) {
            $tongnhaple = $this->getProduct_Total_Nhap($value['idPro'],$value['cuahang_id']);
            $tongnhapToa = $this->getProduct_Total_NhapToa($value['idPro'],$value['cuahang_id']);

            // Lấy tổng sl và tiền nhập lẻ + nhập toa (tong tiền = sl_lẻ*đơn giá + sl_toa*đơn_giá_toa)
            $product[$key]['tongslnhap']=(int)$tongnhaple['tongslnhap']+(int)$tongnhapToa['tongslnhap'];
            $product[$key]['tongtiennhap']=(int)$tongnhaple['tongtiennhap']+(int)$tongnhapToa['tongtiennhap'];
            
            // Lấy tổng SL và tiền xuất cho khách hàng
            $tongxuatKH = $this->getProduct_KH($value['idPro'],$value['cuahang_id']);
            $product[$key]['tongslKH']=(int)$tongxuatKH['tongslban'];
            $product[$key]['tongtienKH']=(int)$tongxuatKH['tongtienban'];
            
            // Lấy tổng SL và tiền xuất nội bộ
            $tongxuatNB = $this->getProduct_XuatNB($value['idPro'],$value['cuahang_id']);
            $product[$key]['tongslXuatNB']=(int)$tongxuatNB['tongslchuyen'];
            
            // Lấy tổng SL và tiền nhập nội bộ
            $tongxuatNB = $this->getProduct_NhapNB($value['idPro'],$value['cuahang_id']);
            $product[$key]['tongslNhapNB']=(int)$tongxuatNB['tongslchuyen'];
            // $product[$key]['tongtienNB']=(int)$tongxuatKH['tongtienban'];

        }
        return $product;
    }

    public function getProductThongke($cuahang_id = [],$cate_id = [],$idPro='')
    {
        $query = Product::find()->select(['id','idPro','cuahang_id','proName','quantity AS sldauky','([[quantity]] * [[import_price]]) AS tiendk','cate_id'])->indexBy('id')->where('status=:status',[':status'=>true]);
        // ->joinWith(['category cate'],false);
        if(!empty($cuahang_id)){
            $query->andWhere(['in','cuahang_id',$cuahang_id]);
        }
        if(!empty($cate_id)){
            $query->andWhere(['in','cate_id',$cate_id]);
        }
        if($idPro != ''){
            $query->andWhere(['idPro'=>$idPro]);
        }
        
        $query->asArray()->orderBy(['cuahang_id'=>SORT_ASC,'id'=>SORT_ASC,'proName'=>SORT_ASC]);
        
        return $query->all();
    }

    public function getAllProInSearch($cuahang_id='')
    {
        $data = Product::find()->select(['id as masp','CONCAT(idPro," - ",proName) AS tensp','cuahang_id','idPro'])->where('status=:status',[':status'=>true]);
        if($cuahang_id != ''){
            $data->andWhere(['in','cuahang_id',$cuahang_id]);
        }
        
        return $data->asArray()->orderBy(['cuahang_id'=>SORT_ASC,'masp'=>SORT_ASC,'proName'=>SORT_ASC])->all();
    }

    // Hàm lấy tất cả các Cate con của nó
    function getAllIDCate($idCate,$status = true)
    {
        $result = ProductCate::find()->select(['idCate'])->where('status =:active',['active'=>$status])
        ->andWhere(['IN','parent_id',$idCate])->all();
        $idList  = [$idCate];
        foreach ($result as $value) {
            $idList[]  = $value->idCate;
        }
        unset($result);
        return $idList;
    }

    // Hàm lấy tất cả các sản phẩm của product

}
