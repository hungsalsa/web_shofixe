<?php

namespace backend\modules\sanpham\models;

use Yii;
use yii\helpers\ArrayHelper;
use backend\modules\quantri\models\CuaHang;
use backend\models\User;
/**
 * This is the model class for table "tbl_location".
 *
 * @property int $id
 * @property string $name
 * @property int $cuahang_id
 * @property string $note
 */
class Location extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_location';
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
            [['name', 'status', 'cuahang_id'], 'required'],
            [['cuahang_id', 'created_at', 'updated_at', 'user_add'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['status'], 'string', 'max' => 4],
            [['note'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên vị trí',
            'cuahang_id' => 'Cửa hàng',
            'status' => 'Kích hoạt',
            'note' => 'Ghi chú',
            'created_at' => 'Thêm',
            'updated_at' => 'Chỉnh sửa',
            'user_add' => 'Người sửa',
        ];
    }

    public function getCuahang()
    {
        return $this->hasOne(CuaHang::className(), ['id' => 'cuahang_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_add']);
    }

    public function getAllLocation()
    {
        return ArrayHelper::map(self::findAll(['status'=>true]),'id','name');
    }

    public function getName($id)
    {
        $data = self::find()->select('name')->where(['id'=>$id])->one();
        return $data->name;
    }
}
