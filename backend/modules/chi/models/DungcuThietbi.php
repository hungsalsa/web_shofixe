<?php

namespace backend\modules\chi\models;

use Yii;

/**
 * This is the model class for table "dungcu_thietbi".
 *
 * @property int $id
 * @property string $madungcu
 * @property string $name
 * @property int $donvitinh
 * @property int $quantity
 * @property int $status
 * @property int $price
 * @property int $tongnhap
 * @property int $tongxuat
 * @property int $toncuoi
 * @property string $note
 * @property int $updated_at
 * @property int $user_add
 */
class DungcuThietbi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dungcu_thietbi';
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
            [['madungcu', 'name', 'donvitinh', 'quantity', 'status', 'price', 'updated_at', 'user_add'], 'required'],
            [['donvitinh', 'quantity', 'price', 'tongnhap', 'tongxuat', 'toncuoi', 'updated_at', 'user_add'], 'integer'],
            [['madungcu', 'name'], 'string', 'max' => 100],
            [['status'], 'string', 'max' => 4],
            [['note'], 'string', 'max' => 255],
            [['madungcu'], 'unique'],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'madungcu' => Yii::t('app', 'Mã dụng cụ'),
            'name' => Yii::t('app', 'Tên'),
            'donvitinh' => Yii::t('app', 'Đơn vị tính'),
            'quantity' => Yii::t('app', 'Tồn đầu kỳ'),
            'status' => Yii::t('app', 'Kích hoạt'),
            'price' => Yii::t('app', 'Giá nhập'),
            'tongnhap' => Yii::t('app', 'Tổng SL nhập'),
            'tongxuat' => Yii::t('app', 'Tổng SL xuất'),
            'toncuoi' => Yii::t('app', 'Tồn cuối'),
            'note' => Yii::t('app', 'Ghi chú'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'user_add' => Yii::t('app', 'User Add'),
        ];
    }
}
