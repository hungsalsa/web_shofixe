<?php

namespace backend\modules\khachhang\models;

use Yii;
use yii\helpers\ArrayHelper;
use backend\modules\quantri\models\Motorbike;

/**
 * This is the model class for table "kh_xe".
 *
 * @property int $id
 * @property int $id_KH
 * @property int $xe
 * @property string $bks
 * @property int $status
 * @property string $nguoi_sd
 */
class KhXe extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kh_xe';
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
            // [['xe', 'bks','color'], 'required'],
            // [['status'], 'string', 'max' => 4],
            // [['color', 'quanhe'], 'string', 'max' => 20],
            // [['id_KH', 'xe'], 'integer'],
            // [['bks'], 'string', 'max' => 15],
            // // [['status'], 'integer', 'max' => 4],
            // [['nguoi_sd'], 'string', 'max' => 30],
            // // [['id_KH', 'bks'], 'unique', 'targetAttribute' => ['id_KH', 'bks']],
            // [['bks'], 'unique', 'message'=>'Biển số này đã có, hãy kiểm tra lại'],


            [['xe', 'bks', 'color'], 'required','message'=>'{attribute} không được để trống'],
            [['id_KH', 'xe'], 'integer'],
            [['bks'], 'string', 'min' => 5, 'max' => 15,'message'=>'{attribute} lớn hơn 5 ký tự,nhỏ hơn 15 ký tự'],
            // [['bks'], 'string', 'max' => 15,'message'=>'{attribute} nhỏ hơn 15 ký tự'],
            ['bks', 'match', 'not' => true, 'pattern' => '/[^a-zA-Z0-9-.]/', 'message' => '{attribute} chỉ bao gồm các ký tự a->z, A->Z,1->9,"-" và ko chứa khoảng trắng'],
            [['color', 'quanhe'], 'string', 'max' => 20],
            [['nguoi_sd'], 'string', 'max' => 30],
            [['bks'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'id_KH' => 'Khách hàng',
            'xe' => 'Xe của khách',
            'bks' => 'Biển số',
            'quanhe' => 'Quan hệ',
            'color' => 'Màu xe',
            'nguoi_sd' => 'Người sử dụng',
        ];
    }

    public function getXeKhach()
    {
        return $this->hasOne(Motorbike::className(), ['id' => 'xe']);
    }
    public function getKhachhang()
    {
        return $this->hasOne(KhachHang::className(), ['idKH' => 'id_KH']);
    }

    public function getDichvu()
    {
        return $this->hasMany(KhDichvu::className(), ['id_xe' => 'id']);
    }
    // Hamf laays phuc vụ tìm kiếm khách hàng, 
    public function AllXeByID($id_KH)
    {
        $data =  self::find()->alias('xek')
        ->select(['CONCAT(mt.bikeName, " - ",xek.bks) AS TTXEKH'])
        ->innerJoinWith('khachhang kh',false)
        ->innerJoinWith('xeKhach mt',false)
        ->andWhere(['xek.id_KH' =>$id_KH])
        ->asArray()->orderBy(['name'=>SORT_ASC, 'phone'=>SORT_ASC , 'xek.bks'=>SORT_ASC ])->all();
        $name = '';
        foreach ($data as $key => $value) {
                $name .= ' / '.$value['TTXEKH'];
        }
        return $name;
    }


    public function getTTXe($id){
        $data = self::find()->alias('xek')
        // ->select(['xek.xe','bks','mt.bikeName AS tenxe'])
        ->select(['CONCAT(mt.bikeName, " / BKS: ",xek.bks) AS tenxe','xek.id AS maxe'])
        ->JoinWith('xeKhach mt',false)
        ->andWhere(['xek.id' =>$id])->asArray()
        ->one();
        return $data['tenxe'];
    }

    // Hàm phục vụ thêm dịch vụ khách hàng khi biết ID, trả về dsách xe (mảng)
    public function getAllXekhach($idKH)
    {
        $data = self::find()->alias('xek')
        ->select(['CONCAT(mt.bikeName, " - ",xek.bks) AS TTXEKH','xek.id AS maxe'])
        // ->select(['CONCAT(mt.bikeName, " - ",xek.bks, " - ",kh.name, " - ", kh.phone) AS TTXEKH','xek.id AS maxe'])
        // ->innerJoinWith('khachhang kh',false)
        ->innerJoinWith('xeKhach mt',false)
        ->andWhere(['xek.id_KH' =>$idKH])
        ->asArray()
        // ->orderBy(['xek.bks'=>SORT_ASC,'mt.bikeName'=>SORT_ASC ])
        ->all();
        return ArrayHelper::map($data,'maxe','TTXEKH');
    }
    // public function getAllXekhach($idKH)
    // {
    //     return self::find()->alias('xek')
    //     ->select(['CONCAT(mt.bikeName, " - ",xek.bks) AS TTXEKH','xek.id AS maxe'])
    //     // ->select(['CONCAT(mt.bikeName, " - ",xek.bks, " - ",kh.name, " - ", kh.phone) AS TTXEKH','xek.id AS maxe'])
    //     ->innerJoinWith('khachhang kh',false)
    //     ->innerJoinWith('xeKhach mt',false)
    //     ->andWhere(['xek.id_KH' =>$idKH])
    //     ->asArray()->orderBy(['name'=>SORT_ASC, 'phone'=>SORT_ASC , 'xek.bks'=>SORT_ASC ])->all();
    // }

    public function GetKH()
    {
        return self::find()->alias('xek')
        ->select(['CONCAT(kh.name, " - ", kh.phone," - ",kh.address, " - ",mt.bikeName, " - ",xek.bks) AS TTKH','xek.id AS makhach','idKH'])
        ->joinWith('khachhang kh',false)
        ->joinWith('xeKhach mt',false)
        ->orderBy(['name'=>SORT_ASC, 'xek.bks'=>SORT_ASC ])
        ->asArray()->all();

    }

    public function getXeKH()
    {
        return self::find()->alias('xek')
        ->select(['CONCAT(mt.bikeName, " - ",xek.bks) AS TTXEKH','xek.id AS maxe'])
        ->innerJoinWith('xeKhach mt',false)
        ->asArray()->all();
    }

    // Hàm sử dụng trong thống kê xe, in hóa đơn DepDrop
    public function getSubkhachhang($id)
    {
        return self::find()->alias('xek')
        ->select(['CONCAT(mt.bikeName, " - ",xek.bks) AS name','xek.id AS id'])
        ->innerJoinWith('xeKhach mt',false)
        ->andWhere(['xek.id_KH' =>$id])
        ->asArray()
        ->all();
    }

    // Hàm sử dụng trong thống kê xe, khi search có khách hàng
    public function Laydanhsachxe($id_kh)
    {
        $data =  self::find()->alias('xek')
        ->select(['CONCAT(mt.bikeName, " - ",xek.bks) AS name','xek.id AS id'])
        ->innerJoinWith('xeKhach mt',false)
        ->andWhere(['xek.id_KH' =>$id_kh])
        ->asArray()
        ->all();
        return ArrayHelper::map($data,'id','name');
    }

    public function getAllKhachhang(){

        $data = self::find()->alias('xk')
        // ->select(['xk.id_KH','kh.name','kh.phone','kh.address','xk.bks','xk.xe','xk.bks','xk.bks'])
        // ->select(['{{xk}}.*','kh.name'])
        // ->innerJoinWith('khachhang kh')
        ->joinWith([
            'khachhang kh' => function ($query) {

                 $query->select(['kh.idKH', 'kh.phone']);

                // $query->onCondition(['news_content.language' => \Yii::$app->language]);

            }
        ])
        ->asArray()
        // ->groupBy('kh.idKH')
        ->all();
        return $data;
    }

}
