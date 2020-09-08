<?php

namespace backend\modules\chi\models;
use backend\modules\quantri\models\CuaHang;
use Yii;

/**
 * This is the model class for table "tbl_vattu_th".
 *
 * @property int $id
 * @property string $name
 * @property string $machi
 * @property int $dvt
 * @property int $status
 * @property int $sl_dk
 * @property int $sl_nhap
 * @property int $sl_xuat
 * @property int $sl_ton
 * @property int $updated_at
 * @property int $user_add
 */
class VattuTh extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_vattu_th';
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
        // return [
        //     [['machi', 'name', 'dvt', 'status', 'sl_dk', 'price','cuahang_id'], 'required', 'message' => '{attribute} không thể thiếu'],
        //     [['dvt', 'sl_dk', 'price', 'sl_nhap', 'sl_xuat', 'sl_ton', 'updated_at', 'user_add'], 'integer'],
        //     [['machi'], 'string', 'max' => 100],
        //     [['name'], 'string', 'max' => 150],
        //     [['status'], 'string', 'max' => 4],
        //     [['machi'], 'unique', 'message' => '{attribute} đã có hãy chọn {attribute} khác'],
        //     [['name'], 'unique', 'message' => '{attribute} đã có hãy chọn {attribute} khác'],

        //     [['machi'], 'unique', 'targetClass' => '\backend\modules\chi\models\ChiKhoanchi', 'targetAttribute' => 'makhoanchi', 'message' => '{attribute} đã có trong khoản chi hãy chọn {attribute} khác'], 
        //     [['machi'], 'unique', 'targetClass' => '\backend\modules\sanpham\models\Product', 'targetAttribute' => 'idPro', 'message' => '{attribute} đã có trong sản phẩm hãy chọn {attribute} khác'],
        //     // [['machi'], 'unique', 'targetClass' => '\backend\modules\chi\models\ChiKhoanchi', 'targetAttribute' => 'makhoanchi', 'targetWhere' => ['accountStatus' => 0]], 

        // ];
        return [
            [['machi', 'name', 'cuahang_id', 'dvt', 'status', 'sl_dk', 'price', 'updated_at', 'user_add'], 'required'],
            [['cuahang_id', 'dvt', 'sl_dk', 'price', 'sl_nhap', 'sl_xuat', 'sl_ton', 'updated_at', 'user_add'], 'integer'],
            [['machi'], 'string', 'max' => 100],
            [['name'], 'string', 'max' => 150],
            [['status'], 'string', 'max' => 4],
            [['machi'], 'unique'],
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
            'name' => Yii::t('app', 'Tên vật tư tiêu hao'),
            'machi' => Yii::t('app', 'Mã vật tư'),
            'dvt' => Yii::t('app', 'Đơn vị tính'),
            'status' => Yii::t('app', 'Kích hoạt'),
            'sl_dk' => Yii::t('app', 'Số đầu kỳ'),
            'sl_nhap' => Yii::t('app', 'Sl Nhap'),
            'price' => Yii::t('app', 'Giá nhập'),
            'sl_xuat' => Yii::t('app', 'Sl Xuat'),
            'sl_ton' => Yii::t('app', 'Sl Ton'),
            'cuahang_id' => Yii::t('app', 'Cửa hàng'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'user_add' => Yii::t('app', 'User Add'),
        ];
    }

    public function getCuahang()
    {
        return $this->hasOne(CuaHang::className(), ['id' => 'cuahang_id']);
    }
}
