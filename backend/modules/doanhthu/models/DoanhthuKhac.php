<?php

namespace backend\modules\doanhthu\models;

use Yii;

/**
 * This is the model class for table "tbl_doanhthu_khac".
 *
 * @property int $id
 * @property int $doanhthu_id
 * @property string $name
 * @property int $money
 * @property string $note
 */
class DoanhthuKhac extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_doanhthu_khac';
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
            [['doanhthu_id', 'name', 'money'], 'required'],
            [['doanhthu_id', 'money'], 'integer'],
            [['note'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'doanhthu_id' => 'Doanhthu ID',
            'name' => 'Name',
            'money' => 'Money',
            'note' => 'Note',
        ];
    }

    // Hàm cộng tổng tất cả doanh thu của cửa hàng trong ngày(theo id_doanhthu)
    public function getAll_money_ByDoanhthu($doanhthu_id)
    {

        $data = self::find()->select('money')->where('doanhthu_id =:doanhthu_id',[':doanhthu_id'=>$doanhthu_id])->all();
        $money = 0;
        if(!empty($data)){
            foreach ($data as $value) {
                $money += $value->money;
            }
        }
        
        return $money;
    }
}
