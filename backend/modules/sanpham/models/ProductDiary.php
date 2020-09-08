<?php

namespace backend\modules\sanpham\models;

use Yii;
use backend\modules\doanhthu\models\CuaHang;
use backend\modules\sanpham\models\Product;
/**
 * This is the model class for table "tbl_product_diary".
 *
 * @property int $id
 * @property string $pro_id
 * @property int $cuahang_id
 * @property int $quantity
 * @property int $status
 * @property int $date
 */
class ProductDiary extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_product_diary';
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
            [['day', 'pro_id', 'cuahang_id', 'quantity', 'status', 'created_ad'], 'required'],
            [['day', 'store_number'], 'safe'],
            [['cuahang_id', 'store_number', 'quantity', 'created_ad','pro_id'], 'integer'],
            // [['pro_id'], 'string', 'max' => 255],
            [['status'], 'integer', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'day' => 'Ngày sửa',
            'pro_id' => 'Mã SP',
            'cuahang_id' => 'Cửa hàng',
            'store_number' => 'Tồn kho',
            'quantity' => 'Số lượng',
            'status' => 'Status',
            'created_ad' => 'Vào lúc',
        ];
    }

    public function addNew($idPro,$cuahang_id,$quantity,$status,$day)
    {
        $productdiary = new ProductDiary();
        $product = Product::findOne(['idPro'=>$idPro,'cuahang_id'=>$cuahang_id]);
            
        
        $productdiary->day = $day;
        $productdiary->pro_id = $idPro;
        $productdiary->cuahang_id = $cuahang_id;
        $productdiary->quantity = $quantity;
        if ($product) {
            $productdiary->store_number = $product->quantity;
        }else {
            $productdiary->store_number = $quantity;
        }
        $productdiary->status = $status;
        $productdiary->created_ad = time();
        $productdiary->save();
        return $productdiary->errors;
    }

    public function addDiary($id,$quantity,$status,$day,$slton)
    {
        $productdiary = new ProductDiary();
        $product = Product::findOne($id);
// echo '<pre>';print_r($product);die;
        $productdiary->day = $day;
        $productdiary->pro_id = $id;
        $productdiary->cuahang_id = $product->cuahang_id;
        $productdiary->quantity = $quantity;
        $productdiary->store_number = $slton;
        $productdiary->status = $status;
        $productdiary->created_ad = time();
        $productdiary->save();
        return $productdiary->errors;
    }

    public function Themnhatky($id,$quantity,$status,$day)
    {
        $productdiary = new ProductDiary();
        $product = Product::findOne($id);
// echo '<pre>';print_r($product);die;
        $productdiary->day = $day;
        $productdiary->pro_id = $id;
        $productdiary->cuahang_id = $product->cuahang_id;
        $productdiary->quantity = $quantity;
        $productdiary->store_number = $product->quantity;
        $productdiary->status = $status;
        $productdiary->created_ad = time();
        $productdiary->save();
        return $productdiary->errors;
    }

    public function updateDiary($idPro,$cuahang_id,$quantity,$status,$day)
    {
        $productdiary = ProductDiary::findOne(['pro_id'=>$idPro,'cuahang_id'=>$cuahang_id,'status'=>$status,'day'=>$day]);
        $product = Product::findOne(['idPro'=>$idPro,'cuahang_id'=>$cuahang_id]);
        if(!empty($productdiary)){
            $productdiary->quantity = $quantity;
            $productdiary->store_number = $product->quantity;
            $productdiary->status = $status;
            $productdiary->created_ad = time();
            $productdiary->save();
            return $productdiary->errors;
        }
// return $productdiary;
        // $productdiary->pro_id = $idPro;
        // $productdiary->cuahang_id = $cuahang_id;
    }

    public function getCuahang()
    {
        return $this->hasOne(CuaHang::className(), ['id' => 'cuahang_id']);
    }
}
