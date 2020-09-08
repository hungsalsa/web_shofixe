<?php

namespace backend\modules\quantri\models;

use Yii;

/**
 * This is the model class for table "tbl_supplier".
 *
 * @property int $id
 * @property string $supName
 * @property string $address
 * @property string $phone
 * @property string $note
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $user_add
 */
class Supplier extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_supplier';
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
            [['supName', 'status', 'created_at', 'updated_at', 'user_add'], 'required'],
            [['note'], 'string'],
            [['congno', 'created_at', 'updated_at', 'user_add'], 'integer'],
            [['supName', 'address'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 15],
            [['status'], 'string', 'max' => 4],
            [['supName'], 'unique'],
            [['phone'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'supName' => 'Tên',
            'congno' => 'Nợ đầu kỳ',
            'address' => 'Địa chỉ',
            'phone' => 'Số điện thoại',
            'note' => 'Ghi chú',
            'status' => 'Kích hoạt',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_add' => 'User Add',
        ];
    }
}
