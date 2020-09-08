<?php

namespace backend\modules\doanhthu\models;

use Yii;
use yii\helpers\ArrayHelper;
use backend\modules\quantri\models\CuaHang;
/**
 * This is the model class for table "tbl_doanh_thu".
 *
 * @property int $id
 * @property string $ngay
 * @property int $tt_ck
 * @property int $tt_the
 * @property int $tt_tien_mat
 * @property int $tien_chi
 * @property int $tien_hom Tiền đếm trong hòm
 * @property int $tien_le tiền lẻ giao còn thừa
 * @property int $chenh_lech
 * @property int $ketoan
 * @property int $nguoi_ky
 * @property string $note
 * @property int $cua_hang
 * @property int $created_at
 * @property int $updated_at
 * @property int $user_add
 */
class DoanhThu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_doanh_thu';
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
            [['ngay', 'giao_sang', 'tong_tien_mat', 'tt_tien_mat', 'tien_hom', 'ketoan', 'nguoi_ky', 'cua_hang', 'status', 'created_at', 'updated_at', 'user_add'], 'required'],
            [['ngay', 'tien_chi', 'chenh_lech'], 'safe'],
            [['id_cuahang_ngay','giao_sang', 'tt_ck', 'tong_tien_mat', 'tt_the', 'tt_tien_mat', 'tong_doanh_thu_phieu', 'doanh_thu_thuc', 'thu_khac', 'tien_chi', 'tien_hom', 'tien_le', 'chenh_lech', 'ketoan', 'nguoi_ky', 'cua_hang', 'created_at', 'updated_at', 'user_add'], 'integer'],
            [['note'], 'string'],
            // [['status'], 'string', 'max' => 4],
            // [['ngay', 'cua_hang'], 'unique', 'targetAttribute' => ['ngay', 'cua_hang']],
            [['ngay', 'cua_hang'], 'unique', 'targetAttribute' => ['ngay', 'cua_hang'],'message'=>'{attribute} này đã có, kiểm tra lại ngày và cửa hàng'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_cuahang_ngay' => 'id_cuahang_ngay',
            'ngay' => 'Ngày',
            'giao_sang' => 'Giao Sáng',
            'tt_ck' => 'Tiền chuyển khoản',
            'tt_the' => 'Thanh toán thẻ',
            'tt_tien_mat' => 'Thanh toán tiền mặt',
            'tong_doanh_thu_phieu' => 'Tổng doanh thu(phiếu)',
            'doanh_thu_thuc' => 'Doanh Thu Thực',
            'thu_khac' => 'Thu Khác',
            'tien_chi' => 'Tổng tiền chi',
            'tien_hom' => 'Tiền trong hòm',
            'tien_le' => 'Tiền lẻ còn',
            'tong_tien_mat' => 'Tổng tiền mặt',
            'chenh_lech' => 'Chênh Lệch',
            'ketoan' => 'Thu ngân',
            'nguoi_ky' => 'Người giám sát',
            'note' => 'Ghi chú',
            'cua_hang' => 'Cửa hàng',
            'status' => 'Lưu',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Cập nhật',
            'user_add' => 'User Add',
        ];
    }

    public function getCuahang()
    {
        return $this->hasOne(CuaHang::className(), ['id' => 'cua_hang']);
    }

    // Lấy thông tin doanh the theo ID để thêm doanh thu khác
     function getDoanhthuinfo($id)
    {
         $data =  self::find()->asArray()->where('id =:ID',['ID'=>$id])->one();
        $cuahang = new CuaHang();
        $dataCuahang =  $cuahang->getAllCuahang();
        // if (!$cuahang[$data['cua_hang']]) {
        //     throw new NotFoundHttpException('Không tồn tại cửa hàng này');
        // }
        // $dataCuahang = $cuahang->getAllCuahang();
        return array(
            'id'=>$data['id'],
            'ngay'=>$data['ngay'],
            'cua_hang'=>$data['cua_hang'],
            'ten_cua_hang'=>$dataCuahang[$data['cua_hang']],
        );
    }

    // lay thong tin de them vao doanh thu khac
    public function getAllDoanhThu($status=true)
    {
        return ArrayHelper::map(self::find()->where('status=:status',[':status'=>$status])->all(),'id','ngay');
    }


}
