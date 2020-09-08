<?php

namespace backend\modules\sanpham\models;

use Yii;

/**
 * This is the model class for table "update_status".
 *
 * @property int $status
 */
class Capnhat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $status;
    // public static function tableName()
    // {
    //     return 'update_status';
    // }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'required'],
            [['status'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'status' => 'Status',
        ];
    }
}
