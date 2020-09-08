<?php

namespace backend\modules\quantri\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
/**
 * This is the model class for table "tbl_cua_hang".
 *
 * @property int $id
 * @property string $name
 * @property string $note
 * @property string $address
 * @property int $status
 * @property string $phone
 */
class CuaHang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_cua_hang';
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
            [['name', 'status', 'phone'], 'required'],
            [['note'], 'string'],
            [['name', 'address'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 4],
            [['phone'], 'string', 'max' => 11],
            [['name'], 'unique', 'message' => '{attribute} này đã có'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên Cửa hàng',
            'note' => 'Ghi chú',
            'address' => 'Địa chỉ',
            'status' => 'Kích hoạt',
            'phone' => 'Số điện thoại',
        ];
    }

    public function getAllCuahang($status=true)
    {
        return ArrayHelper::map(self::findAll(['status'=>$status]),'id','name');
    }

    public function getNameByArray($idList)
    {
        $name = '';
       foreach ($idList as $id) {
           $name .= $this->getName($id).' - ';
       }
        return rtrim($name, ' - ');
        // Trả về teeb các cửa hàng nối với nhau hiện ra view
    }

    public function getName($id)
    {
        $data = self::find()->select('name')->where('id=:ID',[':ID'=>$id])->one();
        return $data->name;
    }

    public function CuahangThongke()
    {
        return ArrayHelper::map(self::findAll(['status'=>true,'id'=>[1,2,3,4,5]]),'id','name');
    }

    // ?hiện ra danh sách quản lý User
    public function getAllCuahangUser($idCuahangArray)
    {
        $data = self::find()->select(['name','id'])->where('status=:status',[':status'=>true])
        ->andWhere(['IN','id',$idCuahangArray])->asArray()->all();
        $data = ArrayHelper::map($data,'id','name');
        return implode("-",$data);
    }

    // Lấy danh sách cửa hàng theo user đăng nhập
    public function getCuahang_ByUser()
    {
        $query = self::find();

        if($this->User()->manager != 1){
            $query->where(['in', 'id', json_decode(getUser()->cuahang_id)]);
        }
        return ArrayHelper::map($query->all(),'id','name');
    }

    protected function User(){
       if($user = Yii::$app->user->identity){
           return $user;
       }
       throw new NotFoundHttpException('Bạn chưa đăng nhập');
   }
}
