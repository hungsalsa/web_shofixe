<?php

namespace backend\modules\sanpham\models;

use Yii;
use backend\modules\quantri\models\CuaHang;
use backend\modules\quantri\models\Employee;
use backend\models\User;
/**
 * This is the model class for table "tbl_product_transfer".
 *
 * @property int $id_transfer
 * @property string $day
 * @property int $cuahang_id
 * @property int $chuyenden_cuahang
 * @property int $ketoan
 * @property int $nhanvien
 * @property string $note
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $user_add
 */
class ProductTransfer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_product_transfer';
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
            [['day', 'cuahang_id', 'chuyenden_cuahang', 'ketoan', 'nhanvien', 'status'], 'required','message'=>'{attribute} không được để trống'],
            [['day', 'created_at', 'updated_at', 'user_add','type','user_update'], 'safe'],
            [['cuahang_id', 'chuyenden_cuahang', 'ketoan', 'nhanvien', 'created_at', 'updated_at', 'user_add'], 'integer'],
            [['note'], 'string', 'max' => 255],
            [['status', 'type'], 'integer', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_transfer' => 'Id Transfer',
            'day' => 'Ngày chuyển',
            'cuahang_id' => 'Chuyển từ',
            'chuyenden_cuahang' => 'Đến cửa hàng',
            'ketoan' => 'Kế toán',
            'nhanvien' => 'Người chuyển',
            'note' => 'Ghi chú',
            'type' => 'Loại chuyển',
            'status' => 'Trạng thái',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày sửa',
            'user_add' => 'Người tạo',
            'user_update' => 'Người sửa',
        ];
    }

    public function getTransferDetails()
    {
        return $this->hasMany(ProductTransferDetail::className(), ['id_transfer' => 'id_transfer']);
    }

    public function getCuahang()
    {
        return $this->hasOne(CuaHang::className(), ['id' => 'cuahang_id']);
    }

    public function getChuyenden()
    {
        return $this->hasOne(CuaHang::className(), ['id' => 'chuyenden_cuahang']);
    }

    public function getKtoan()
    {
        return $this->hasOne(Employee::className(), ['id' => 'ketoan']);
    }
    public function getNguoichuyen()
    {
        return $this->hasOne(Employee::className(), ['id' => 'nhanvien']);
    }
    
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_add']);
    }
    
    public function getUpdate()
    {
        return $this->hasOne(User::className(), ['id' => 'user_update']);
    }

    // Hàm lấy tất cả các thông tin chuyển phiếu đi 
    public function getTransferTo()
    {
        $cuahang = new CuaHang();
        $dataCuahang = $cuahang->getAllCuahang();
        $cuahang_id = array_keys($cuahang->getCuahang_ByUser());
        $data = [];
        $data['total']=0;
        $data['message']= '<strong>Bạn có:</strong>';
        foreach ($dataCuahang as $key => $value) {
            // Laays tat ca cac don hang luu tam
            if($luutam = $this->getTranfer_Status($cuahang_id,[$key],[0])){
                // $data['luutam'][$key]
                $data['message'] .= '<br>'.$luutam.' chuyển đi cửa hàng: '.$value.' lưu tạm ';
                if (isset($data['luutam'][$key])) {
                    $data['luutam'][$key]['count'] += $luutam;
                    $data['luutam'][$key]['message'] .=  '<br>'.$luutam.' chuyển đi cửa hàng: '.$value.' lưu tạm ';
                } else {
                    $data['luutam'][$key]['count'] = $luutam;
                    $data['luutam'][$key]['message'] = $luutam.' chuyển đi cửa hàng: '.$value.' lưu tạm ';
                }
                $data['total'] += $luutam;
            }

            if($chuyendi = $this->getTranfer_Status($cuahang_id,[$key],[1])){

                $data['message'] .= '<br>'.$chuyendi.' chuyển đi cửa hàng: '.$value.' chưa chấp nhận ';

                if (isset($data['chuyendi'][$key])) {
                    $data['chuyendi'][$key]['count'] += $chuyendi;
                    $data['chuyendi'][$key]['message'] .=  '<br>'.$chuyendi.' chuyển đi cửa hàng: '.$value.' chưa chấp nhận ';
                } else {
                    $data['chuyendi'][$key]['count'] = $chuyendi;
                    $data['chuyendi'][$key]['message'] = $chuyendi.' chuyển đi cửa hàng: '.$value.' chưa chấp nhận ';
                }
                $data['total'] += $chuyendi;
// pr($count);
            }

            if($chuyenden = $this->getTranfer_Status_den([$key],$cuahang_id)){

                $data['message'] .='<br>'.  $chuyenden.' chuyển từ cửa hàng: '.$value;
                if (isset($data['chuyenden'][$key])) {
                    $data['chuyenden'][$key]['count'] += $chuyenden;
                    $data['chuyenden'][$key]['message'] .= '<br>'.  $chuyenden.' chuyển từ cửa hàng: '.$value;
                } else {
                    $data['chuyenden'][$key]['count'] = $chuyenden;
                    $data['chuyenden'][$key]['message'] = $chuyenden.' chuyển từ cửa hàng: '.$value;
                }
                $data['total'] += $chuyenden;
            }
        }
        return $data;
    }

    // Hàm lấy các đơn hàng nội bộ chuyển đi
    public function getTranfer_Status($cuahang_id,$dencuahang,$status)
    {
        $data = self::find()->andWhere(['IN','status',$status]);
        if (!empty($cuahang_id)) {
            $data->andWhere(['IN','cuahang_id',$cuahang_id]);
        }
        if (!empty($dencuahang)) {
            $data->andWhere(['IN','chuyenden_cuahang',$dencuahang]);
        }
        return $data->asArray()->orderBy(['cuahang_id'=>SORT_ASC])->count();
    }

    // Hàm lấy các đơn hàng nội bộ chuyển đến
    public function getTranfer_Status_den($tu_cuahang_id,$cuahang_id)
    {
        $data =  self::find()->where(['status'=>1])->andWhere(['IN','chuyenden_cuahang',$cuahang_id]);
        if (!empty($tu_cuahang_id)) {
            $data->andWhere(['IN','cuahang_id',$tu_cuahang_id]);
        }
        // if ($tu_cuahang_id!='') {
            // $data->andWhere(['IN','cuahang_id',$tu_cuahang_id]);
        // }
        // if ($dencuahang!='') {
            // $data->andWhere(['IN','chuyenden_cuahang',$dencuahang]);
        // }
        return $data->count();
    }
}
