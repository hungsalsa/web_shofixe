<?php

namespace backend\modules\phieu\models;

use Yii;
use yii\helpers\ArrayHelper;
use backend\modules\quantri\models\CuaHang;
use backend\modules\quantri\models\Employee;
use backend\modules\phieu\models\PhieuSophieu;
use backend\models\User;
/**
 * This is the model class for table "phieu_giao".
 *
 * @property int $id
 * @property string $ngay_giao
 * @property int $sophieu_dau
 * @property int $sophieu_cuoi
 * @property int $nguoi_giao
 * @property int $nguoi_nhan
 * @property string $note
 */
class PhieuGiao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phieu_giao';
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
            
            [['ngay_giao', 'cuahang_id', 'sophieu_dau', 'sophieu_cuoi', 'nguoi_giao', 'nguoi_nhan', 'status'], 'required'],
            [['ngay_giao'], 'safe'],
            [['cuahang_id', 'sophieu_dau', 'sophieu_cuoi', 'nguoi_giao', 'nguoi_nhan', 'created_at', 'user_add'], 'integer'],
            [['note'], 'string'],
            // [['status'], 'string', 'max' => 4],
            // [['ngay_giao', 'cuahang_id'], 'unique', 'targetAttribute' => ['ngay_giao', 'cuahang_id'],'message'=>'{attribute} này đã có, kiểm tra lại ngày chi và cửa hàng'],

            // ['sophieu_dau','compare','compareAttribute'=>'sophieu_cuoi','operator'=>'>','message'=>'{attribute} phải nhỏ hơn {compareAttribute} '],
            // [['sophieu_cuoi'],'compare','compareAttribute'=>'sophieu_dau','operator'=>'<','message'=>'{attribute} phải >= {compareAttribute}'],

            [['sophieu_cuoi'],'validateSo'],
            // [['sophieu_cuoi'],'kiemtraphieu','on' => 'create'],
            // [['cuahang_id'],'kiemtraphieu','on' => 'create'],
            // [['ngay_giao', 'cuahang_id'], 'unique', 'targetAttribute' => ['ngay_giao', 'cuahang_id']],
        ];
    }

    public function validateSo($attribute)
    {
        if($this->$attribute<$this->sophieu_dau){
            $this->addError($attribute,'Số phiếu đầu phải nhỏ hơn số cuối');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ngay_giao' => 'Ngày giao',
            'cuahang_id' => 'Cửa hàng',
            'sophieu_dau' => 'Số phiếu đầu',
            'sophieu_cuoi' => 'Số phiếu cuối',
            'nguoi_giao' => 'Người giao',
            'nguoi_nhan' => 'Người nhận',
            'status' => 'Trạng thái',
            'note' => 'Ghi chú',
            'created_at' => Yii::t('app', 'Tạo lúc'),
            'user_add' => Yii::t('app', 'Người tạo'),
        ];
    }

    // Tìm ID phiếu giao để xóa phiếu thiếu
    public function finIDphieugiao($ngay_giao,$cuahang_id)
    {
        $data = self::find()->select('id')->where('ngay_giao=:ngay_giao AND cuahang_id=:cuahang_id',['ngay_giao'=>$ngay_giao,'cuahang_id'=>$cuahang_id])->one();
        return $data->id;
    }

    // Lấy tất cả các ngày giao theo user đăng nhập
    public function getAllDatePhieu()
    {
        $user = $this->findIdCuahang();
        return ArrayHelper::map(self::find()->where(['in', 'cuahang_id', $user])->all(),'ngay_giao','ngay_giao');
    }

    public function getCuahang()
    {
        return $this->hasOne(CuaHang::className(), ['id' => 'cuahang_id']);
    }
    public function getNguoigiao()
    {
        return $this->hasOne(Employee::className(), ['id' => 'nguoi_giao']);
    }
    public function getNguoinhan()
    {
        return $this->hasOne(Employee::className(), ['id' => 'nguoi_nhan']);
    }
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_add']);
    }

    // Kiểm tra số phiếu để kiểm tra số phiếu giao đã có chưa?
    // với cuahang_id,so_phieu là value kiểm tra
    // sophieu_dau,sophieu_cuoi,cuahang_id truyền vào
    public function kiemtraphieu($attribute)
    {
        $phieu = new PhieuSophieu();
        $dau = $this->sophieu_dau;
        $cuoi = $this->sophieu_cuoi;
        $cuahang_id = $this->cuahang_id;

        while ($cuoi >= $dau) {
            if(!empty($phieu->checkphieuCH($cuoi, $cuahang_id))){
               $this->addError($attribute,'Số phiếu trong khoảng này của cửa hàng đã có, xin kiểm tra lại');
            }
            $cuoi--;
        }
    }

    protected function findIdCuahang(){
       if($user = Yii::$app->user->identity){
           return json_decode($user->cuahang_id);

       }
       throw new NotFoundHttpException('Không tìm thấy bản ghi nào');
   }

}
