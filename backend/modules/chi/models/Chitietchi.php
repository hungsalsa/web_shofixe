<?php

namespace backend\modules\chi\models;

use Yii;
use backend\modules\quantri\models\Employee;
use backend\modules\quantri\models\Supplier;
use backend\modules\quantri\models\Motorbike;
/**
 * This is the model class for table "chi_chitietchi".
 *
 * @property int $id
 * @property int $name
 * @property int $quantity
 * @property double $money
 * @property int $motorbike
 * @property int $bill_number
 * @property int $employee_id
 * @property string $note
 * @property int $chikhac_id
 */
class Chitietchi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chi_chitietchi';
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
            [['name', 'quantity', 'money','ncc_id'], 'required'],
            [['name', 'quantity','ncc_id', 'chikhac_id','motorbike'], 'integer'],
            [['chikhac_id','ncc_id'], 'safe'],
            [['money'], 'number'],
            [['note'], 'string', 'max' => 255],
            [['name', 'chikhac_id'], 'unique', 'targetAttribute' => ['name', 'chikhac_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên khoản chi',
            'quantity' => 'Số lượng',
            'money' => 'Đơn giá',
            'ncc_id' => 'Nguồn nhập',
            'motorbike' => 'Cho xe',
            'note' => 'Note',
            'chikhac_id' => 'Chingay ID',
        ];
    }


    public function getKhoanchi()
    {
        return $this->hasOne(ChiKhoanchi::className(), ['id' => 'name']);
    }


    public function getNcc()
    {
        return $this->hasOne(Supplier::className(), ['id' => 'ncc_id']);
    }
    public function getXe()
    {
        return $this->hasOne(Motorbike::className(), ['id' => 'motorbike']);
    }

    public function getChingay()
    {
        return $this->hasOne(Chingay::className(), ['id' => 'chikhac_id']);
    }

    public function getIdKhoanchi(){
        $data = self::find()->select('name')->distinct()->indexBy('name')->orderBy(['chikhac_id' => SORT_ASC])->all();
        $id =[];
        foreach ($data as $key => $value) {
            $id[] = $key;
        }
        return $id;
    }
    
}
