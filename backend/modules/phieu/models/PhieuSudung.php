<?php

namespace backend\modules\phieu\models;

use Yii;
use backend\modules\phieu\models\PhieuSophieu;
use backend\modules\quantri\models\CuaHang;
/**
 * This is the model class for table "phieu_sudung".
 *
 * @property int $id
 * @property int $so_phieu_dau
 * @property int $so_phieu_cuoi
 * @property string $ngay_sd
 * @property string $phieu_huy lam thanh select multi
 * @property int $sl_phieu_tot
 * @property int $ke_toan
 * @property string $note
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $user_create
 */
class PhieuSudung extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phieu_sudung';
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
            [['cuahang_id', 'ngay_sd', 'so_phieu_dau', 'so_phieu_cuoi', 'ke_toan', 'quan_ly', 'created_at', 'updated_at', 'user_create'], 'required'],
            [['cuahang_id', 'so_phieu_dau', 'so_phieu_cuoi', 'sl_phieu_tot', 'ke_toan', 'quan_ly', 'created_at', 'updated_at', 'user_create'], 'integer'],
            [['ngay_sd'], 'safe'],
            [['note'], 'string'],
            // [['phieu_ton', 'phieu_ton_tt', 'phieu_huy'], 'string', 'max' => 255],
            // [['status'], 'string', 'max' => 4],
            [['cuahang_id', 'ngay_sd'], 'unique', 'targetAttribute' => ['cuahang_id', 'ngay_sd']],
            [['so_phieu_cuoi'], 'validatePhieu'],

            [['phieu_huy','phieu_ton'], 'Validatephieuhuy'],


            // ['phieu_huy', 'exist', 'targetAttribute' => ['phieu_ton']],

            [['phieu_ton'], 'checkphieuTon'],
            // [['so_phieu_cuoi'], 'validatePhieuUpdate', 'on' => 'update'],
            ['so_phieu_cuoi', 'compare','compareAttribute'=>'so_phieu_dau','operator'=>'>=', 'message'=>'Số cuối phải lơn hơn số đầu', 'type' => 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cuahang_id' => 'Cửa hàng',
            'ngay_sd' => 'Ngày sử dụng',
            'so_phieu_dau' => 'Số đầu sd',
            'so_phieu_cuoi' => 'Số cuối sd',
            'phieu_ton' => 'Phiếu đã sử dụng(chưa T2)',
            'phieu_ton_tt' => 'Phiếu thanh toán(ngày trước)',
            'phieu_huy' => 'Phiếu đã sử dụng nhưng hủy',
            'sl_phieu_tot' => 'Tổng phiếu tốt',
            'ke_toan' => 'Thu ngân',
            'quan_ly' => 'Quản lý',
            'note' => 'Ghi chú',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_create' => 'User Create',
        ];
    }


    public function Validatephieuhuy($attribute,$params){

        // $phieu_ton = $params['phieu_ton'];
        // $phieu_huy = $this->phieu_huy;
        $phieu_ton = $this->phieu_ton;
        $phieu_huy = $this->phieu_huy;
        if ($phieu_ton !='' && $phieu_huy !='') {
            foreach ($phieu_ton as $value) {
                if (in_array($value,$phieu_huy)) {
                    $this->addError($attribute, 'Phiếu hủy không thể giống phiếu tồn');
                }
            }
            // $this->addError($model, $attribute, 'Either '.$attribute.' or '.$this->other.' is required!');
        }
    }
    public function checkphieuTon($attribute){
        $cuahang_id = $this->cuahang_id;
        $so_phieu_dau = $this->so_phieu_dau;
        $so_phieu_cuoi = $this->so_phieu_cuoi;
        $phieu_ton = $this->phieu_ton;
        $phieu_huy = $this->phieu_huy;

        foreach ($phieu_ton as $value) {
            if($value < $so_phieu_dau || $value > $so_phieu_cuoi){
                $this->addError($attribute, 'Phiếu tồn không nằm trong danh sách phiếu sử dụng');
            }
        }
    }

    public function getCuahang()
    {
        return $this->hasOne(CuaHang::className(), ['id' => 'cuahang_id']);
    }

    // Kiem tra so phieu da su dung chua tạo mới
    
    // Kiem tra so phieu da su dung chua tạo mới
    public function validatePhieu($attribute, $params)
    {
        $cuahang_id = $this->cuahang_id;
        $so_phieu_dau = $this->so_phieu_dau;
        $so_phieu_cuoi = $this->$attribute;
        $phieu = new PhieuSophieu();
        $error = true;
        while ($so_phieu_dau<=$so_phieu_cuoi) {
            // kiem tra phieu co phai la cua cua hang nay ko?

            $check = $phieu->checkphieu($cuahang_id,$so_phieu_dau);
            if($check){
                $error = false;
            }
            $so_phieu_dau++;
        }
        if ($error == true) {
            $this->addError($attribute, 'Không có phiếu nào bạn chọn trong cửa hàng bạn quản lý');
        }
        
    }
    // Kiem tra so phieu da su dung chua update
    public function validatePhieuUpdate($attribute, $params)
    {
        $ngay_sd = $this->ngay_sd;
        $so_phieu_dau = $this->so_phieu_dau;
        $so_phieu_cuoi = $this->$attribute;
        while ($so_phieu_dau<=$so_phieu_cuoi) {
            $check = PhieuSophieu::checkPhieuSDUpdate($so_phieu_dau,$ngay_sd);
            if($check){
                $this->addError($attribute, 'trong các số phiếu này đã đã có phiếu sử dụng xin kiểm tra lại');
            }
            $so_phieu_dau++;
        }
        
    }

    
    public function getPhieuTons()
    {
        return $this->hasMany(PhieuTon::className(), ['ngay_sd' => 'id']);
    }

    // public function check_phieu($attribute, $params)
    // {
    //     $phieu = new PhieuSophieu();
    //     if(!$phieu->checkphieu($this->ngay_giao,$this->$attribute)){
    //         $this->addError($attribute, 'Ngày này không có phiếu này, xin kiểm tra lại');
    //     }
    // }
}
