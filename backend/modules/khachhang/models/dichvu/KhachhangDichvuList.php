<?php

namespace backend\modules\khachhang\models\dichvu;

use Yii;

/**
 * This is the model class for table "khachhang_dichvu_list".
 *
 * @property int $id
 * @property string $madichvu
 * @property string $tenhoadon
 * @property string $tendv
 * @property int $price
 * @property int $price_sale
 * @property string $xe_sd
 * @property int $phutung
 * @property int $updated_at
 * @property int $status
 * @property int $user_add
 */
class KhachhangDichvuList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'khachhang_dichvu_list';
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
            [['tendv', 'updated_at', 'status', 'user_add'], 'required'],
            [['price', 'price_sale', 'updated_at', 'user_add'], 'integer'],
            [['madichvu', 'tenhoadon'], 'string', 'max' => 100],
            [['tendv', 'xe_sd'], 'string', 'max' => 255],
            [['phutung', 'status'], 'string', 'max' => 4],
            [['tendv'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'madichvu' => 'Madichvu',
            'tenhoadon' => 'Tenhoadon',
            'tendv' => 'Tendv',
            'price' => 'Price',
            'price_sale' => 'Price Sale',
            'xe_sd' => 'Xe Sd',
            'phutung' => 'Phutung',
            'updated_at' => 'Updated At',
            'status' => 'Status',
            'user_add' => 'User Add',
        ];
    }
}
