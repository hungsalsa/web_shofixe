<?php

namespace backend\modules\phieu\models;

use Yii;

/**
 * This is the model class for table "phieu_ton".
 *
 * @property int $id
 * @property int $so_phieu_ton
 * @property string $ngay_sd
 * @property int $status
 */
class PhieuTon extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phieu_ton';
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
            [['so_phieu_ton'], 'required'],
            [['so_phieu_ton'], 'integer'],
            [['ngay_sd'], 'safe'],
            [['note'], 'string'],
            // [['status'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'so_phieu_ton' => 'Số phiếu',
            'ngay_sd' => 'Ngày sử dụng',
            'note' => 'Ghi chú',
            'status' => 'Status',
        ];
    }

    public function getNgaySd()
    {
        return $this->hasOne(PhieuSudung::className(), ['id' => 'ngay_sd']);
    }
}
