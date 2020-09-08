<?php

namespace backend\modules\khachhang\models\dichvu;

use Yii;

/**
 * This is the model class for table "kh_dichvu".
 *
 * @property int $iddv
 * @property string $day
 * @property int $cuahang_id
 * @property int $id_kh
 * @property int $id_xe
 * @property int $total_money
 * @property int $thanhtoan cách thanh toán, 0+> tiền mặt , 1=>thẻ, 2=> chuyển khoản
 * @property int $tienthu_kh
 * @property string $id_nhanvien
 * @property int $id_ketoan
 * @property int $id_quanly
 * @property int $sophieu
 * @property string $bandau
 * @property string $tontai
 * @property string $note
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $user_add
 * @property string $time_from
 * @property string $time_to
 */
class KhDichvu2 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kh_dichvu';
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
            [['day', 'cuahang_id', 'id_kh', 'id_xe', 'thanhtoan', 'tienthu_kh', 'id_nhanvien', 'id_ketoan', 'id_quanly', 'sophieu', 'status', 'created_at', 'updated_at', 'user_add', 'time_from', 'time_to'], 'required'],
            [['day', 'time_from', 'time_to'], 'safe'],
            [['cuahang_id', 'id_kh', 'id_xe', 'total_money', 'tienthu_kh', 'id_ketoan', 'id_quanly', 'sophieu', 'created_at', 'updated_at', 'user_add'], 'integer'],
            [['bandau', 'tontai'], 'string'],
            [['thanhtoan', 'status'], 'string', 'max' => 4],
            [['id_nhanvien', 'note'], 'string', 'max' => 255],
            [['day', 'id_xe'], 'unique', 'targetAttribute' => ['day', 'id_xe']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'iddv' => 'Iddv',
            'day' => 'Day',
            'cuahang_id' => 'Cuahang ID',
            'id_kh' => 'Id Kh',
            'id_xe' => 'Id Xe',
            'total_money' => 'Total Money',
            'thanhtoan' => 'Thanhtoan',
            'tienthu_kh' => 'Tienthu Kh',
            'id_nhanvien' => 'Id Nhanvien',
            'id_ketoan' => 'Id Ketoan',
            'id_quanly' => 'Id Quanly',
            'sophieu' => 'Sophieu',
            'bandau' => 'Bandau',
            'tontai' => 'Tontai',
            'note' => 'Note',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_add' => 'User Add',
            'time_from' => 'Time From',
            'time_to' => 'Time To',
        ];
    }
}
