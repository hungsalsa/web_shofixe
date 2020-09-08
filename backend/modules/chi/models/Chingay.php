<?php

namespace backend\modules\chi\models;

use Yii;
use backend\modules\quantri\models\CuaHang;
use backend\modules\quantri\models\Employee;
use backend\models\User;
/**
 * This is the model class for table "chi_chingay".
 *
 * @property int $id
 * @property string $day Ngày chi
 * @property int $cuahang_id
 * @property int $nguoi_chi
 * @property int $total_money
 * @property string $note
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $user_add
 */
class Chingay extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chi_chingay';
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
            [['day', 'cuahang_id', 'nguoi_chi', 'status','nguoimua','kieunhap'], 'required'],
            [['day'], 'safe'],
            [['cuahang_id', 'nguoi_chi','nguoimua', 'total_money', 'created_at', 'updated_at', 'user_add'], 'integer'],
            [['note'], 'string'],
            [['status'], 'string', 'max' => 4],
            [['day', 'cuahang_id','nguoimua','nguoi_chi'], 'unique', 'targetAttribute' => ['day', 'cuahang_id','nguoimua','nguoi_chi'],'message' => 'Ngày đã chọn của cửa hàng này đã có phiếu của người mua và người chi tiền bạn chọn'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'day' => 'Ngày chi',
            'cuahang_id' => 'Cửa hàng',
            'nguoi_chi' => 'Người xuất tiền',
            'nguoimua' => 'Người mua',
            'total_money' => 'Tổng tiền',
            'kieunhap' => 'Kiểu nhập',
            'note' => 'Ghi chú',
            'status' => 'Trạng thái',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày sửa',
            'user_add' => 'Người sửa',
        ];
    }

    public function getChitiet()
    {
        return $this->hasMany(Chitietchi::className(), ['chikhac_id' => 'id']);
    }

    public function getCuahang()
    {
        return $this->hasOne(CuaHang::className(), ['id' => 'cuahang_id']);
    }

    public function getKetoan()
    {
        return $this->hasOne(Employee::className(), ['id' => 'nguoi_chi']);
    }
    public function getMuahang()
    {
        return $this->hasOne(Employee::className(), ['id' => 'nguoimua']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_add']);
    }

    public function getAllChiByMonth($cuahang_id =[],$start_date ='',$end_date ='')
    {
        $data = self::find()->alias('cn')->select(['cn.id','total_money','day','cuahang_id'])->joinWith(['chitiet ct']);
        
        if($start_date !='' && $end_date !=''){
            $data->andWhere(['between', 'day', $start_date, $end_date]);
        }

        // // Nếu ko phải quản lý
        // $user = Yii::$app->user->identity; 
        // $data->andWhere(['IN','ct.name',[192,194,350]]);
        if(!empty($cuahang_id)){
            $data->andWhere(['IN','cuahang_id',$cuahang_id]);
        }
        return $data->orderBy(['cuahang_id' => SORT_ASC,'day' => SORT_ASC])->all();
    }


}
