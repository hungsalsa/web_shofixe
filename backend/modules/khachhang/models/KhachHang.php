<?php

namespace backend\modules\khachhang\models;

use Yii;
use yii\helpers\ArrayHelper;
use backend\modules\quantri\models\Motorbike;
use backend\modules\khachhang\models\KhXe;
use backend\models\User;
/**
 * This is the model class for table "khach_hang".
 *
 * @property int $idKH
 * @property string $name
 * @property string $phone
 * @property string $address
 * @property int $created_at
 * @property int $status
 * @property int $updated_at
 * @property int $user_add
 */
class KhachHang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'khach_hang';
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

            [['name', 'phone','address'], 'required','message'=>'{attribute} không được để trống'],
            [['birthday', 'age', 'job'], 'safe'],
            [['age', 'created_at', 'updated_at', 'user_add', 'status'], 'integer'],
            [['name', 'email'], 'string', 'max' => 100],
            // [['job'], 'string', 'max' => 4],
            [['facebook', 'address'], 'string', 'max' => 255],
            [['note'], 'string'],
            [['phone'], 'string', 'max' => 12],
            ['phone', 'match', 'not' => true, 'pattern' => '/[^0-9]/', 'message' => '{attribute} chỉ bao gồm các số 0->9 và ko chứa khoảng trắng'],
            [['phone'], 'unique', 'message' => '{attribute} số điện thoại này đã có, kiểm tra lại khách hàng'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idKH' => 'Mã khách hàng',
            'name' => 'Tên khách hàng',
            'phone' => 'Số điện thoại',
            'address' => 'Địa chỉ',
            'created_at' => 'Tạo lúc',
            'updated_at' => 'Chỉnh sửa',
            'status' => 'Status',
            'note' => 'Ghi chú',
            'updated_at' => 'Chỉnh sửa',
            'user_add' => 'Người sửa',
            'birthday' => 'Ngày sinh',
            'age' => 'Độ tuổi',
            'job' => 'Nghề nghiệp',
            'facebook' => 'Facebook',
            'email' => 'Email',
        ];
    }

    

    public function finOneKH($idKH){
        return self::find()->alias('kh')
        ->innerJoinWith('xeKH xk')
        ->select([
            'kh.idKH',
            'kh.name',
            'kh.phone',
            'kh.address',
            'kh.note',
                    // 'xek.bks AS xeKH', // select all customer fields
        ])
        ->andWhere(['kh.idKH' =>$idKH])
        ->asArray()
        ->orderBy(['xk.id'=>SORT_ASC ])
        ->one();
    }

    public function getAllKH()
    {
        return KhXe::find()->alias('xek')
        ->select(['CONCAT(kh.name, " - ", kh.phone," - ",kh.address, " - ",mt.bikeName, " - ",xek.bks) AS TTKH','idKH'])
        ->innerJoinWith('khachhang kh',false)
        ->innerJoinWith('xeKhach mt',false)
        ->asArray()->orderBy(['name'=>SORT_ASC, 'phone'=>SORT_ASC , 'xek.bks'=>SORT_ASC ])->all();
    }
    public function getOneAllKH($idKH)
    {
        return KhXe::find()->alias('xek')
        ->select(['CONCAT(kh.name, " - ", kh.phone," - ",kh.address, " - ",mt.bikeName, " - ",xek.bks) AS TTKH','idKH'])
        ->innerJoinWith('khachhang kh',false)
        ->innerJoinWith('xeKhach mt',false)
        ->andWhere(['kh.idKH' =>$idKH])
        ->asArray()->orderBy(['name'=>SORT_ASC, 'phone'=>SORT_ASC , 'xek.bks'=>SORT_ASC ])->all();
    }

    public function getXeKH()
    {
        return $this->hasMany(KhXe::className(), ['id_KH' => 'idKH']);
    }

    public function getDichvu()
    {
        return $this->hasMany(KhDichvu::className(), ['id_kh' => 'idKH']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_add']);
    }


    // Lấy thông tin dich vụ khách hàng
    public function get_All_service($id_KH)
    {
        return self::find()->alias('kh')
        ->innerJoinWith('dichvu dv')
        ->select([
            'kh.idKH',
            'kh.name',
            'kh.phone',
            'kh.address',
                    // 'xek.bks AS xeKH', // select all customer fields
        ])
        ->andWhere(['kh.idKH' =>$id_KH])
        ->asArray()
        ->orderBy(['dv.id_xe'=>SORT_ASC ])
        ->one();
    }

    // // Lấy thông tin khách hàng + tất cả các xe:: đổ về mảng cho ra dropdown
    // public function AllKhachhang()
    // {
    //     $data = self::find()->alias('kh')
    //     ->select(['kh.idKH','kh.name','kh.phone','kh.address','CONCAT(kh.name, "-",kh.phone,"/",kh.address) AS TTKH'])
    //     ->joinWith([
    //         'xeKH xek' => function ($query) {
    //             $query->select(['xek.id_KH','CONCAT(mo.bikeName, "-",xek.bks) AS Xekhachhang']);
    //             $query->joinWith('xeKhach mo',false);
    //         }
    //     ])
    //     ->asArray()
    //     ->all();
    //         // dbg($data);
    //     $khachhang=[];
    //     foreach ($data as $value) {
    //         $khachhang[$value['idKH']] = $value['TTKH'];
    //         if (count($value['xeKH'])>1) {
    //                 // foreach ($value['xeKH'] as $xe) {
    //                 //     $khachhang[$value['idKH']] .='/'.$xe['Xekhachhang'];
    //                 // }
    //         } else {
    //             $khachhang[$value['idKH']] .='/'.$value['xeKH'][0]['Xekhachhang'];
    //         }
    //     }
    //     unset($data);
    //     return $khachhang;
    // }

    // Hàm Laays tat ca cac khach hang, phục vụ tìm kiếm
    private function get_Khachhang_ALL()
    {
        return self::find()
        ->select([
            'CONCAT(name, "-",phone,"/",address) AS TTKH',
            'idKH',
        ])
        ->asArray()
        ->orderBy(['idKH'=>SORT_ASC, 'phone'=>SORT_ASC])
        ->all();
    }

    // Ham tạo mới dịch vụ khách hàng

    public function getOneKH($idkh)
    {
        $data =  self::find()->alias('kh')
        // ->innerJoinWith('xeKH xek',true)
     //    ->joinWith(['xeKH' => function (\yii\db\ActiveQuery $query) { 

     // // HERE - Fields to select

     //       $query->select(['id','xe','bks']);

     //       // $query->andWhere('date_end IS NULL');

     //   }])

        ->select([
            'CONCAT(name, "-",phone,"/",address) AS TTKH',
            'idKH'
        ])
        ->where(['kh.idKH'=>$idkh])
        ->asArray()
        ->one();
        return [$data['idKH']=>$data['TTKH']];
    }
    // Ham lay tat ca cac khach hang va xe khach hang de tim kiem
    public function AllKhachhang()
    {
        $khachhang = $this->get_Khachhang_ALL();
        $xekhach = new KhXe();
        foreach ($khachhang as $key => $value) {
            $khachhang[$key]['name'] = $value['TTKH'].$xekhach->AllXeByID($value['idKH']);
        }
        return ArrayHelper::map($khachhang,'idKH','name');//    dbg($khachhang);
    }
}
