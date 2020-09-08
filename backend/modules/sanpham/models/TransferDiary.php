<?php

namespace backend\modules\sanpham\models;

use Yii;

/**
 * This is the model class for table "tbl_transfer_diary".
 *
 * @property int $id
 * @property int $id_transfer
 * @property string $date
 * @property int $status_transfer
 * @property int $updated_at
 */
class TransferDiary extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_transfer_diary';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_transfer','status_transfer', 'updated_at'], 'required'],
            [['id_transfer', 'updated_at'], 'integer'],
            [['status_transfer'], 'integer', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_transfer' => 'Id Transfer',
            'status_transfer' => 'Status Transfer',
            'updated_at' => 'Updated At',
        ];
    }
}
