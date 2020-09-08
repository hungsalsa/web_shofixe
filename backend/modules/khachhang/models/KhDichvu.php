<?php

namespace backend\modules\khachhang\models;

use Yii;
use backend\modules\quantri\models\CuaHang;
use backend\modules\quantri\models\Employee;
use backend\modules\phieu\models\PhieuSophieu;
use backend\models\User;
/**
 * This is the model class for table "kh_dichvu".
 *
 * @property int $iddv
 * @property string $day
 * @property int $cuahang_id
 * @property int $id_kh
 * @property int $id_xe
 * @property int $total_money
 * @property string $id_nhanvien
 * @property int $id_ketoan
 * @property int $id_quanly
 * @property string $note
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $user_add
 */
class KhDichvu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kh_dichvu';
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
            [['day', 'cuahang_id', 'id_xe','id_ketoan', 'id_quanly','sophieu', 'status', 'time_from', 'time_to'], 'required','message'=>'{attribute} không được để trống'],
            // [['day','thanhtoan', 'time_from', 'time_to'], 'safe'],
            // [['id_nhanvien'], 'id_nhanvien_check'],
            
            // [['day', 'id_kh', 'created_at', 'updated_at', 'user_add', 'time_from', 'time_to'], 'safe'],
            [['cuahang_id', 'id_kh', 'id_xe', 'total_money', 'id_ketoan','sophieu', 'id_quanly', 'created_at', 'updated_at', 'user_add','thanhtoan','tienthu_kh'], 'integer'],
            [['note'], 'string', 'max' => 255],

            [['bandau', 'tontai'], 'string'],

            [['day', 'id_xe', 'cuahang_id', 'id_kh'], 'unique', 'targetAttribute' => ['day', 'id_xe', 'cuahang_id', 'id_kh']],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'iddv' => 'Iddv',
            'tontai' => 'Tồn tại',
            'bandau' => 'Tình trạng ban đầu',
            'day' => 'Ngày sửa chữa',
            'cuahang_id' => 'Tại cửa hàng',
            'id_kh' => 'Khách hàng',
            'id_xe' => 'Xe của khách',
            'total_money' => 'Tổng tiền',
            'id_nhanvien' => 'Kỹ thuật',
            'id_ketoan' => 'Kế toán',
            'id_quanly' => 'Quản lý',
            'sophieu' => 'Số phiếu',
            'note' => 'Ghi chú',
            'status' => 'Trạng thái',
            'created_at' => 'Created At',
            'updated_at' => 'Update At',
            'user_add' => 'User Add',
            'time_from' => Yii::t('app', 'Giờ đến'),
            'time_to' => Yii::t('app', 'Giờ về'),
            'thanhtoan' => Yii::t('app', 'Thanh toán'),
            'tienthu_kh' => Yii::t('app', 'Tiền khách trả'),
        ];
    }

    // public function id_nhanvien_check($attribute, $params){
    //     if (!is_array(json_decode($this->id_nhanvien))) {
    //         $this->addError($attribute  ,"$this->id_nhanvien");
    //     }
    //     // return false;
    // }


    public function getChitietdv()
    {
        return $this->hasMany(KhChitietDv::className(), ['id_dv' => 'iddv']);
    }

    public function getKhachhang()
    {
        return $this->hasOne(KhachHang::className(), ['idKH' => 'id_kh']);
    }

    public function getPhieu()
    {
        return $this->hasOne(PhieuSophieu::className(), ['id' => 'sophieu']);
    }

    public function getXesua()
    {
        return $this->hasOne(KhXe::className(), ['id' => 'id_xe']);
    }

    public function getCuahang()
    {
        return $this->hasOne(CuaHang::className(), ['id' => 'cuahang_id']);
    }

    public function getKetoan()
    {
        return $this->hasOne(Employee::className(), ['id' => 'id_ketoan']);
    }

    public function getQuanly()
    {
        return $this->hasOne(Employee::className(), ['id' => 'id_quanly']);
    }
    
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_add']);
    }

    // Tra cứu TT khách hàng , tìm kiểm dv
    public function getAllDichvu($idKH,$id_xe = ''){
        $data =  self::find()->alias('dv')
        ->JoinWith(['chitietdv ct','phieu ph'])
        ->andWhere(['id_kh'=>$idKH]);
        if ($id_xe != '') {
            $data->andWhere(['id_xe'=>$id_xe]);
        }
        return $data->asArray()->all();
    }

    public function getAllDate()
    {
        $data = self::find()->select('day')->distinct()->all();
        $list =[];
        foreach ($data as $value) {
            $list[$value->day] = Yii::$app->formatter->asDate($value->day, 'dd-M-Y');
        }

        return $list;
    }

    // Tra cứu hóa đơn, để in hóa đơn
    // tìm những khachs hàng sử dụng dv để in
    public function getDichvuKH($idKH,$xe_kh,$ngay_in){
        return self::find()->alias('dv')
        ->JoinWith(['chitietdv ct','khachhang','xesua'])
        ->andWhere(['dv.id_kh'=>$idKH,'id_xe'=>$xe_kh,'day'=>$ngay_in])
            // ->asArray()
        ->one();
    }

    public function OneDichvuKH($idKH,$ngay_in){
        return self::find()->alias('dv')
        // ->select(['dv.day','ch.name','xe.bks','kh.name'])
        ->joinWith('chitietdv ct',true)
        ->joinWith('khachhang kh',true)
        ->joinWith('xesua xe',true)
        ->joinWith('cuahang ch',true)

        ->andWhere(['dv.id_kh'=>$idKH,'dv.day'=>$ngay_in])
        ->all();
    }

    // Kết nối dịch vụ KH với khách hàng
    public function get_Dichvu_KH($idKH,$ngay_in){
        return self::find()->alias('dv')
        ->select(['dv.day','kh.name AS tenkh','dv.id_xe'])
        ->innerJoinWith('khachhang kh', false)
            // ->innerJoinWith('chitietdv ct', false)
            // ->JoinWith(['chitietdv ct','khachhang'])
            // ->innerJoinWith('xesua xe', false)
        ->andWhere(['dv.id_kh'=>$idKH,'dv.day'=>$ngay_in])
        ->all();
    }

    public function getCountServices()
    {
        return self::find()->where(['=','day',date("Y/m/d")])->count();
    }

    /*HÀM LẤY DANH SÁCH CÁC ĐƠN HÀNG CHƯA CẬP NHẬT*/
    public function getKHdv_status($cuahang_id='')
    {
        $data =  self::find()->alias('dv')
            // ->joinWith(['chitietdv ct'],true)
        ->where('dv.status=:active',[':active'=>0]);
        if ($cuahang_id !='') {
            $data->andWhere(['IN','cuahang_id',$cuahang_id]);
        }
        return $data->asArray()->orderBy(['dv.cuahang_id'=>SORT_ASC,'dv.status'=>SORT_ASC])
        ->all();
    }

    // Hàm sử dụng trong in hóa đơn DepDrop
    public function getNgayKH($id_KH,$xe_KH)
    {
        $data = self::find()
        ->select(['day as name','iddv as id'])
        ->distinct()
        // ->innerJoinWith('xeKhach mt',false)
        ->andWhere(['id_kh' =>$id_KH,'id_xe'=>$xe_KH])
        ->asArray()
        ->all();

        $selected = '';
        $out = '';

        foreach ($data as $dat => $datas) {
            $out[] = ['id' => $datas['name'], 'name' => Yii::$app->formatter->asDate($datas['name'], 'd-M-Y')];

            if($dat == 0){
                $aux = $datas['name'];
            }

            ($datas['id'] == $id_KH) ? $selected = $id_KH : $selected = $aux;

        }
        return $output = [
            'out' => $out,
            'selected' => $selected
        ];
    }

    /*HÀM TRẢ VỀ XE KHÁC HÀNG SỬ DỤNG DỊCH VỤ*/
    public function getXekhachhang($iddv)
    {
        $data = self::find()->alias('dv')
                ->joinWith(['xesua'],true)
                ->where(['iddv'=>$iddv])
                ->one();
                return $data;
    }
}
