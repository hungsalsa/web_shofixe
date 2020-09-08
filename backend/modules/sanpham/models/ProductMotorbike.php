<?php

namespace backend\modules\sanpham\models;

use Yii;
use backend\modules\quantri\models\Motorbike;
/**
 * This is the model class for table "tbl_product_motorbike".
 *
 * @property int $id
 * @property int $pro_id
 * @property int $motor_id
 */
class ProductMotorbike extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_product_motorbike';
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
            [['pro_id', 'motor_id'], 'required','message'=>'{attribute} không được để trống'],
            [['pro_id', 'motor_id'], 'integer'],
            [['pro_id', 'motor_id'], 'unique', 'targetAttribute' => ['pro_id', 'motor_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pro_id' => 'Sản phẩm',
            'motor_id' => 'Xe sử dụng',
        ];
    }

    public function getSanpham()
    {
        return $this->hasOne(Product::className(), ['id' => 'pro_id']);
    }

    public function getXedung()
    {
        return $this->hasOne(Motorbike::className(), ['id' => 'motor_id']);
    }
}
