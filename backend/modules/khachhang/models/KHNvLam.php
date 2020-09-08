<?php

namespace backend\modules\khachhang\models;

use Yii;

/**
 * This is the model class for table "kh_nv_lam".
 *
 * @property int $id
 * @property int $id_xe
 * @property int $id_nhanvien
 */
class KHNvLam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kh_nv_lam';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_xe', 'id_nhanvien'], 'required'],
            [['id_xe', 'id_nhanvien'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_xe' => 'Id Xe',
            'id_nhanvien' => 'Id Nhanvien',
        ];
    }
}
