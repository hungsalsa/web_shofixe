<?php

namespace backend\modules\quantri\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "tbl_employee_cuahang".
 *
 * @property int $id
 * @property int $id_employee
 * @property int $cuahang_id
 */
class EmployeeCuahang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_employee_cuahang';
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
            [['id_employee', 'cuahang_id'], 'required'],
            [['id_employee', 'cuahang_id'], 'integer'],
            [['id_employee', 'cuahang_id'], 'unique', 'targetAttribute' => ['id_employee', 'cuahang_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_employee' => 'Tên nhân viên',
            'cuahang_id' => 'Làm tại',
        ];
    }

    public function getCuahang()
    {
        return $this->hasOne(CuaHang::className(), ['id' => 'cuahang_id']);//->select('name');
    }

    public function getNhanvien()
    {
        return $this->hasOne(Employee::className(), ['id' => 'id_employee']);
    }

    // Lấy nhân viên thuộc cửa hàng
    public function NhanvienCH($idnhanvien)
    {
        $data = self::find()->where(['id_employee'=>$idnhanvien])->all();
        return $data;
    }
    public function getNhanvien_User(){
        $data = self::find()->distinct();
        if (getUser()->manager != 1) {
            $data->andWhere(['in','cuahang_id',json_decode(getUser()->cuahang_id)]);
        }
       return  $data->asArray()->orderBy(['id_employee'=>SORT_ASC,'cuahang_id'=>SORT_ASC])->all();
         // $array =[];
         // foreach ($data as $value) {
         //     $array[] = $value['id_employee'];
         // }
        // return $data;
    }
}
