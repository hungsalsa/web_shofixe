<?php

namespace backend\modules\khachhang\models;

use Yii;
use backend\modules\sanpham\models\Product;
/**
 * This is the model class for table "kh_chitiet_dv".
 *
 * @property int $id
 * @property int $id_dv
 * @property int $id_Pro_dv
 * @property int $price
 * @property int $quantity
 */
class KhChitietDv extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kh_chitiet_dv';
    }

    public static function getDb()
    {
        return Yii::$app->get('db1');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_Pro_dv', 'price', 'quantity'], 'required','message'=>'{attribute} không được để trống'],
            [['id_dv', 'id_Pro_dv', 'price', 'quantity'], 'integer'],
            [['suffixes'], 'string', 'max' => 100],
            
            // [['id_dv', 'id_Pro_dv'], 'unique', 'targetAttribute' => ['id_dv', 'id_Pro_dv']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_dv' => 'Id Dv',
            'id_Pro_dv' => 'Tên dịch vụ',
            'price' => 'Đơn giá',
            'quantity' => 'Số lượng',
            'suffixes' => 'Hậu tố',
        ];
    }

    

    public function getDichvu()
    {
        return $this->hasOne(KhDichvu::className(), ['iddv' => 'id_dv']);
    }

    public function getDanhsachdv()
    {
        return $this->hasOne(KhachhangDichvuList::className(), ['id' => 'id_Pro_dv']);
    }

    public function getTotalMoney($idKH,$ngay_in =''){

        $data = self::find()->alias('ct')
        ->JoinWith(['dichvu dv'])
        ->where(['dv.id_kh'=>$idKH]);
        if ($ngay_in != '') {
            $data->andWhere(['dv.day'=>$ngay_in]);
        }
        return $data->sum('ct.price');
    }

    // Lấy thông tin sản phẩm đưa ra thống kê
    public function AllXuatBan($idPro,$cuahang_id)
    {
        return $data = self::find()->alias('ct')
        // ->select(['SUM(ct.quantity) as TongSL','SUM(ct.price*ct.quantity) AS tongtien')])
        ->select(['dsdv.tendv', 'dsdv.madichvu', 'SUM([[ct.quantity]] * [[ct.price]]) AS tongtien','SUM(ct.quantity) as TongSL'])

        ->joinWith(['dichvu dv','danhsachdv dsdv'],false)
        ->where(['dsdv.madichvu'=>$idPro,'dsdv.phutung'=>1,'dv.cuahang_id'=>$cuahang_id,'dv.status'=>true])
        ->asArray()->one();
    }

    // Lấy thông tin sản phẩm đưa ra thống kê chi tiết
    public function AllXuatCT($idPro,$cuahang_id)
    {
        return $data = self::find()->alias('ct')
        // ->select(['SUM(ct.quantity) as TongSL','SUM(ct.price*ct.quantity) AS tongtien')])
        ->select(['dsdv.tendv', 'dsdv.madichvu', 'SUM([[ct.quantity]] * [[ct.price]]) AS tongtien','SUM(ct.quantity) as TongSL','dv.day'])

        ->joinWith(['dichvu dv','danhsachdv dsdv'],false)
        ->where(['dsdv.madichvu'=>$idPro,'dsdv.phutung'=>1,'dv.cuahang_id'=>$cuahang_id,'dv.status'=>true])
        ->asArray()->one();
    }
}
