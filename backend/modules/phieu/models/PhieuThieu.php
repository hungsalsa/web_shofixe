<?php

namespace backend\modules\phieu\models;

use Yii;
use backend\modules\phieu\models\PhieuSophieu;
use backend\modules\quantri\models\CuaHang;
/**
 * This is the model class for table "phieu_thieu".
 *
 * @property int $id
 * @property string $ngay_giao
 * @property int $so_phieu
 * @property int $status
 */
class PhieuThieu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phieu_thieu';
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
            [['ngay_giao', 'cuahang_id', 'so_phieu', 'status', 'created_at', 'updated_at', 'user_add'], 'required'],
            [['ngay_giao'], 'safe'],
            [['cuahang_id', 'created_at', 'updated_at', 'user_add'], 'integer'],
            [['note'], 'string'],
            // [['so_phieu'], 'string', 'max' => 255],
            // [['so_phieu'], 'checkIsArray'],
            [['status'], 'string', 'max' => 4],
            // [['so_phieu', 'cuahang_id'], 'unique', 'targetAttribute' => ['so_phieu', 'cuahang_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ngay_giao' => 'Ngày giao',
            'cuahang_id' => 'Cửa hàng',
            'so_phieu' => 'Số phiếu',
            'note' => 'Note',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_add' => 'User Add',
        ];
    }

    public function checkIsArray(){
       if(!is_array($this->so_phieu)){
           $this->addError('so_phieu','so_phieu is not array!');
       }
   }
    
    public function getCuahang()
    {
        return $this->hasOne(CuaHang::className(), ['id' => 'cuahang_id']);
    }
    
    // đếm số phiếu thiếu cửa hàng _ ngày giao
    public function getCount($ngay_giao,$cuahang_id)
    {
        return self::find()->where('ngay_giao=:ngay_giao AND cuahang_id=:cuahang_id',[':ngay_giao'=>$ngay_giao,':cuahang_id'=>$cuahang_id])->count();
    }
}
