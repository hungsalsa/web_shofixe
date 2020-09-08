<?php

namespace backend\modules\quantri\models;

use Yii;
use yii\helpers\ArrayHelper;
use backend\models\User;
// use backend\modules\quantri\models\EmployeeCuahang;
class Employee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_employee';
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
            [['name', 'location','status', 'created_at', 'updated_at', 'user_add'], 'required'],
            [['created_at', 'updated_at', 'user_add'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 12],
            [['location'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên nhân viên',
            'phone' => 'Số điện thoại',
            'location' => 'Vị trí',
            'status' => 'Trạng thái',
            'cua_hang' => 'Làm tại',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_add' => 'User Add',
        ];
    }

    public function getCuahang()
    {
        return $this->hasOne(CuaHang::className(), ['id' => 'cua_hang']);
    }
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_add']);
    }
    public function getNhanviench()
    {
        return $this->hasMany(EmployeeCuahang::className(), ['id_employee' => 'id']);
    }

    public function getName($id)
    {
        $data = self::find()->select('name')->where('id=:ID',[':ID'=>$id])->one();
        return $data->name;
    }

    public function getNhanvien_id(){
        $data = self::find()->alias('nv')
        ->select(['nv.id','nv.name'])
        ->innerJoinWith(['nhanviench'])
        ->where('nv.status=:status',[':status'=>true])
        // ->asArray()
        ->all();
        foreach ($data as $key => $value) {
            foreach ($value['nhanviench'] as $keynv => $nhanviench) {
                $data[$key]->name .= ' / '.$nhanviench->cuahang->name;
            }
            unset($data[$key]['nhanviench']);
            
        }
     

        return ArrayHelper::map($data,'id','name');
    }

    public function getListNhanvien($json){
        // dbg($json);
        if ($json) {
            $json = json_decode($json);
            $name = '';
            foreach ($json as $value) {
                $name .= $this->getName($value).'-';
            }
            return rtrim($name,'-');
        } else {
            return '';
        }
        
    }
}
