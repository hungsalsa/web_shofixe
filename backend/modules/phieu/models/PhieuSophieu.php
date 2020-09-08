<?php

namespace backend\modules\phieu\models;

use Yii;
use yii\helpers\ArrayHelper;
use backend\modules\quantri\models\CuaHang;
/**
 * This is the model class for table "phieu_sophieu".
 *
 * @property int $id
 * @property string $ngay_giao
 * @property int $cuahang_id
 * @property string $ngay_sd
 * @property string $ngay_tt
 * @property int $so_phieu
 * @property int $status 0=> ko tồn1=>tồn
 */
class PhieuSophieu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phieu_sophieu';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
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
            [['ngay_giao', 'cuahang_id', 'so_phieu', 'status'], 'required'],
            [['ngay_giao', 'ngay_sd', 'ngay_tt'], 'safe'],
            [['cuahang_id', 'so_phieu'], 'integer'],
            // [['status'], 'string', 'max' => 4],
            [['so_phieu', 'cuahang_id'], 'unique', 'targetAttribute' => ['so_phieu', 'cuahang_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ngay_giao' => 'Ngày giao',
            'cuahang_id' => 'Của cửa hàng',
            'ngay_sd' => 'Ngày sử dụng',
            'ngay_tt' => 'Ngày thanh toán',
            'so_phieu' => 'Số phiếu',
            'status' => 'Trạng thái',
        ];
    }



    /*HÀM THÊM 1 PHIẾU KHI GIAO PHIẾU*/
    private function addSophieu($ngay_giao,$cuahang_id,$sophieu)
    {
        $model = new PhieuSophieu();
        $model->ngay_giao = $ngay_giao;
        $model->cuahang_id = $cuahang_id;
        $model->so_phieu = $sophieu;
        $model->status = 0;
        return $model->save();
    }

    /*THÊM NHIỀU PHIẾU KHI GIAO*/
    public function AddGiaophieu($ngay_giao,$cuahang_id,$sodau,$socuoi)
    {
        if ($sodau <= $socuoi) {
            while ($sodau <= $socuoi) {
                $this->addSophieu($ngay_giao,$cuahang_id,$sodau);
                $sodau++;
            }
            return true;
        }else {
            return false;
        }
    }

    /*HÀM XÓA PHIẾU TRONG GIAO PHIẾU*/
    public function xoaphieu($ngay_giao,$cuahang_id,$sophieu)
    {
        $model = self::findOne(['ngay_giao'=>$ngay_giao,'cuahang_id'=>$cuahang_id,'so_phieu'=>$sophieu]);
        if ($model) {
            return $model->delete();
        }else {
            return false;
        }
    }

    // TRẢ VỀ DANH SÁCH CÁC ID PHIẾU , dùng trong xóa và thêm phiếu giao
    public function getAllIDPhieu($ngay_giao,$cuahang_id,$sodau,$socuoi)
    {
        $idList = [];
        if ($sodau <= $socuoi) {
            while ($sodau <= $socuoi) {
                $one = $this->getOneIdphieu($ngay_giao,$cuahang_id,$sodau);
                $idList[] = $one;
                // dbg($one);
                $sodau++;
            }
        }
        return $idList;
    }

    // lấy id phiếu khi xóa phiếu, để phục vụ xóa
    private function getOneIdphieu($ngay_giao,$cuahang_id,$sophieu)
    {
        $data = self::find('id')->select('id')->where(['ngay_giao'=>$ngay_giao,'cuahang_id'=>$cuahang_id,'so_phieu'=>$sophieu])->one();
        return $data->id;
    }

    public function getCuahang()
    {
        return $this->hasOne(CuaHang::className(), ['id' => 'cuahang_id']);
    }

    // Hàm lấy danh sách các phiếu để làm phiếu thiếu
    public function AllPhieuThieu($ngay_giao,$cuahang_id)
    {
        $data = self::find()->where(['ngay_giao'=>$ngay_giao,'cuahang_id'=>$cuahang_id])->all();
        return ArrayHelper::map($data,'id','so_phieu');
    }

    // Hàm trả về danh sach so phieu trong danh sách ID số phiếu
    public function Sophieu($idList)
    {
        $data = self::find()->select(['id','so_phieu'])->where(['IN','id',$idList])->all();
        $data = ArrayHelper::map($data,'id','so_phieu');
        return implode("/",$data);
    }

    // HÀM CẬP NHẬT TRẠNG THÁI KHI THÊM DỊCH VỤ KHÁCH HÀNG, Ngày thanh toán, ngày sử dụng
    public function UpdateStatus($idphieu,$status,$ngay_sd,$ngay_tt)
    {
        $data = self::findOne($idphieu);
        $data->status = $status;
        $data->ngay_sd = $ngay_sd;
        $data->ngay_tt = $ngay_tt;
        
        return $data->save();
    }

    // public function getAllCuahangUser($idCuahangArray)
    // {
    //     $data = self::find()->select(['name','id'])->where('status=:status',[':status'=>true])
    //     ->andWhere(['IN','id',$idCuahangArray])->asArray()->all();
    //     $data = ArrayHelper::map($data,'id','name');
    //     return implode("-",$data);
    // }

    public function getSophieu($status = false){
        $data = self::find()->alias('sp')->select(['CONCAT(so_phieu,"->",cu.name) AS sophieu','sp.id','cuahang_id','so_phieu'])
        ->where('sp.status=:active',[':active'=>$status])
        ->innerJoinWith('cuahang cu',false)->asArray();
        if ($this->Userlogin()->manager != 1) {
            $data->andWhere(['in','cuahang_id',json_decode($this->Userlogin()->cuahang_id)]);
        }
        return $data->orderBy(['cuahang_id'=>SORT_ASC,'so_phieu'=>SORT_ASC])->all();
    }

    public function getSophieuByID($id)
    {
        $data = self::find()->select(['so_phieu'])->where('id=:so',[':so'=>$id])->one();
        return $data->so_phieu;
    }

    // Lấy thông tin đăng nhập
    protected function Userlogin(){
       if($user = Yii::$app->user->identity){
           return $user;
        
       }
       throw new NotFoundHttpException('Không tìm thấy bản ghi nào');
   }

    // Để làm cập nhật giao phiếu
    public function getPhieucapnhat($ngay_giao,$phieu_dau,$phieu_cuoi,$cuahang_id)
    {
        // Tìm tất cả số phiếu của cửa hàng
        return self::find()->where('cuahang_id=:cuahang_id',[':cuahang_id'=>$cuahang_id])->andWhere(['>=','so_phieu',$phieu_dau])->andWhere(['<=','so_phieu',$phieu_cuoi])->all();
    }
}
