<?php

namespace backend\modules\quantri\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "tbl_product".
 *
 * @property int $id
 * @property string $pro_name
 * @property string $title
 * @property string $slug
 * @property string $keyword
 * @property string $description
 * @property string $short_introduction
 * @property string $content
 * @property int $price
 * @property int $price_sales
 * @property string $start_sale
 * @property string $end_sale
 * @property int $order
 * @property int $active
 * @property string $product_type_id
 * @property int $salse
 * @property int $hot
 * @property int $best_seller
 * @property int $manufacturer_id Hãng sản xuất ra sản phẩm
 * @property int $guarantee
 * @property string $models_id Loại xe sử dụng sản phẩm
 * @property int $views
 * @property string $code Mã sản phẩm nếu có
 * @property string $image
 * @property string $images_list
 * @property string $tags
 * @property int $product_category_id
 * @property string $related_articles
 * @property string $related_products
 * @property int $created_at
 * @property int $updated_at
 * @property int $user_id
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pro_name', 'slug', 'description', 'content', 'product_category_id', 'created_at', 'updated_at', 'user_id'], 'required'],
            [['keyword', 'description', 'short_introduction', 'content'], 'string'],
            [['price', 'price_sales', 'order', 'manufacturer_id', 'guarantee', 'views', 'product_category_id', 'created_at', 'updated_at', 'user_id'], 'integer'],
            [['start_sale', 'end_sale'], 'safe'],
            [['pro_name', 'title', 'slug', 'product_type_id', 'models_id', 'code', 'image', 'images_list', 'tags', 'related_articles', 'related_products'], 'string', 'max' => 255],
            [['active', 'salse', 'hot', 'best_seller'], 'string', 'max' => 4],
            [['pro_name', 'slug'], 'unique', 'targetAttribute' => ['pro_name', 'slug']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pro_name' => 'Tên',
            'title' => 'Tiêu đề',
            'slug' => 'Đường dẫn',
            'keyword' => 'Keyword',
            'description' => 'Description',
            'short_introduction' => 'Mô tả ngắn',
            'content' => 'Chi tiết',
            'price' => 'Giá',
            'price_sales' => 'Giá bán',
            'start_sale' => 'Ngày đầu giảm',
            'end_sale' => 'Ngày cuối giảm',
            'order' => 'Sắp xếp',
            'active' => 'Trạng thái',
            'product_type_id' => 'Loại SP',
            'salse' => 'Salse',
            'hot' => 'Hot',
            'best_seller' => 'Best Seller',
            'manufacturer_id' => 'Nhà sản xuất',
            'guarantee' => 'Bảo hành',
            'models_id' => 'Xe sử dụng',
            'views' => 'Views',
            'code' => 'Mã SP',
            'image' => 'Ảnh SP',
            'images_list' => 'Images List',
            'tags' => 'Tags',
            'product_category_id' => 'Danh mục SP',
            'related_articles' => 'Bài viết liên quan',
            'related_products' => 'Sản phẩm liên quan',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày sửa',
            'user_id' => 'User thêm',
        ];
    }
    // cho sang sản phẩm mới, tin liên quan
    public function getAllProduct($status = true)
    {
        return ArrayHelper::map(self::find()->where('active=:active',[':active'=>$status])->all(),'id','pro_name');
    }
}
