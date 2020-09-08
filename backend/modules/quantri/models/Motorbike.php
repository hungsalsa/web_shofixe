<?php

namespace backend\modules\quantri\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_motorbike".
 *
 * @property int $id
 * @property string $bikeName
 * @property int $hangxe_id
 * @property string $note
 * @property int $status
 */
class Motorbike extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_motorbike';
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
            [['bikeName', 'hangxe_id', 'status'], 'required'],
            [['hangxe_id'], 'integer'],
            [['note'], 'string'],
            [['bikeName'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 4],
            [['bikeName'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bikeName' => 'Tên xe',
            'hangxe_id' => 'Thuộc hãng',
            'note' => 'Note',
            'status' => 'Trạng thái',
        ];
    }

    public function getHang()
    {
        return $this->hasOne(Hangxe::className(), ['id' => 'hangxe_id']);
    }

    public function getAllMotorbike($status=true)
    {
        return ArrayHelper::map(Motorbike::find()->where('status =:Status',['Status'=>$status])->all(),'id','bikeName');
    }

    
    public function getMotorName($id,$status=true)
    {
        $data =  Motorbike::find()->select('bikeName')->where('status =:Status AND id=:id',['Status'=>$status,'id'=>$id])->one();
        if (empty($data)) {
            return false;
        } else {
            return $data->bikeName;
        }
    }

    // Hàm trả về danh sách xe sử dụng khi truyền vào 1 mảng
    public function ReturnBikename($bike=[])
    {
        if (empty($bike)) {
            return '';
        }else {
            $data = ArrayHelper::map(self::findAll($bike),'id','bikeName');
            $name ='';
            foreach ($data as $value) {
                $name .= $value.' / ';
            }
            return rtrim($name,' / ');
        }
    }
}
