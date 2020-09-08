<?php

namespace backend\modules\sanpham\models;

use Yii;
use backend\modules\sanpham\models\Product;
/**
 * This is the model class for table "tbl_product_transfer_detail".
 *
 * @property int $id
 * @property int $id_transfer
 * @property string $pro_id
 * @property int $quantity
 * @property string $note
 */
class ProductTransferDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_product_transfer_detail';
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
            [['pro_id', 'quantity'], 'required'],
            [['id_transfer', 'quantity','pro_id'], 'integer'],
            [['note'], 'string'],
            // [['pro_id'], 'string', 'max' => 100],
            // ['quantity','validateNumberPro'],
            [['quantity'], 'integer','min' => 1,'message'=>'Số lượng nhỏ nhất bằng 1'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_transfer' => 'Mã chuyển',
            'pro_id' => 'Sản phẩm',
            'quantity' => 'Số lượng',
            'note' => 'Ghi chú',
        ];
    }

    public function getSanpham()
    {
        return $this->hasOne(Product::className(), ['id' => 'pro_id']);
    }

    public function getChuyenkho()
    {
        // return $this->hasOne(Product::className(), ['idPro' => 'pro_id']);
        return $this->hasOne(ProductTransfer::className(), ['id_transfer' => 'id_transfer']);
    }

    public function validateNumberPro($attribute)
    {
        $product = new Product();

        $quantity = $this->$attribute;
        $product = Product::findOne($this->pro_id);
        $num_product = $product->quantity;
        // print_r($params);die;
        if ($num_product - $quantity < 0 ) {
            $this->addError($attribute, 'Số lượng trong kho của bạn không đủ để xuất');
        }
        if ($quantity <= 0 ) {
            $this->addError($attribute, 'Số lượng xuất phải > 0');
        }
    }
}
