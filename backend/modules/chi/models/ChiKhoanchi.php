<?php

namespace backend\modules\chi\models;

use Yii;
use backend\modules\quantri\models\Unit;
use backend\models\User;
use yii\helpers\ArrayHelper;

class ChiKhoanchi extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'chi_khoanchi';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db2');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['makhoanchi','name', 'donvitinh', 'status', 'loaichi_id'], 'required'],
            [['loaichi_id', 'updated_at', 'user_add'], 'integer'],
            [['makhoanchi'], 'string', 'max' => 100],
            [['name'], 'string', 'max' => 255],
            ['makhoanchi', 'match', 'not' => true, 'pattern' => '/[^a-zA-Z0-9]/', 'message' => '{attribute} chỉ bao gồm các ký tự a->z, A->Z,0->9 và ko chứa khoảng trắng'],
            // [['donvitinh'], 'string', 'max' => 15],
            // [['status'], 'string', 'max' => 4],
            [['name', 'loaichi_id'], 'unique', 'targetAttribute' => ['name', 'loaichi_id']],
            [['name'], 'unique'],
            [['makhoanchi'], 'unique'],
            [['makhoanchi'], 'unique', 'targetClass' => '\backend\modules\sanpham\models\Product', 'targetAttribute' => 'idPro', 'message' => '{attribute} đã có trong sản phẩm hãy chọn {attribute} khác', 'on' => 'create'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'makhoanchi' => 'Mã khoản chi',
            'name' => 'Tên khoản chi',
            'donvitinh' => 'Đơn vị tính',
            'status' => 'Kích hoạt',
            'loaichi_id' => 'Thuộc loại chi',
            'updated_at' => 'Updated At',
            'user_add' => 'User Add',
        ];
    }

    public function getLoaichi()
    {
        return $this->hasOne(ChiLoaichi::className(), ['id' => 'loaichi_id']);
    }
    public function getDvt()
    {
        return $this->hasOne(Unit::className(), ['id' => 'donvitinh']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_add']);
    }

    public function getChitiet()
    {
        return $this->hasMany(Chitietchi::className(), ['chingay_id' => 'id']);
    }

    public function getAllKhoanchi(){
       $data = self::find()->alias('chi')
        ->select(['CONCAT(chi.makhoanchi,"-",chi.name,"-",lc.name) as ten', 'loaichi_id as  loaichi_id','chi.id as id'])
        ->innerJoinWith('loaichi lc',false)
        ->asArray()
        ->all();
         return ArrayHelper::map($data,'id','ten');
    }
    
    /*LẤY TẤT CẢ CÁC KHOẢN CHI LẺ + GCN*/
    public function Khoanchi_IN($loaichi){
      $data = self::find()->alias('chi')
        ->select(['CONCAT(chi.makhoanchi,"-",chi.name,"-",lc.name) as ten', 'loaichi_id','chi.id'])
        ->innerJoinWith('loaichi lc',false)
        ->andWhere(['IN','chi.loaichi_id',$loaichi])
        ->asArray()->orderBy(['lc.name' => SORT_ASC])->all();
        return ArrayHelper::map($data,'id','ten');
    }
    /*LẤY TẤT CẢ CÁC KHOẢN CHI THEO TOA + GCN*/
    public function Khoanchi_NOTIN($loaichi =[]){
       $data= self::find()->alias('chi')
        ->select(['CONCAT(chi.makhoanchi,"-",chi.name,"-",lc.name) as ten', 'loaichi_id as  loaichi_id','chi.id as id'])
        ->innerJoinWith('loaichi lc',false)
        ->andWhere(['NOT IN','chi.loaichi_id',$loaichi])
        ->asArray()->orderBy(['lc.name' => SORT_ASC])->all();
        return ArrayHelper::map($data,'id','ten');
    }

    // Hàm tìm tất cả các khoản chi của 1 sản phẩm, để thống kê "nxt/view($idPro)"
    public function AllChi($idPro)
    {
        return $data = self::find()->alias('kc')
        ->joinWith(['chitiet ct'])
        ->where(['kc.makhoanchi'=>$idPro,'loaichi_id'=>1])
        ->all();
    }

}
