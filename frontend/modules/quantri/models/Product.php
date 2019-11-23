<?php

namespace frontend\modules\quantri\models;

use Yii;
use frontend\modules\quantri\models\ProductCategory;

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
 * @property string $images_large
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
            [['pro_name', 'title', 'slug', 'product_type_id', 'models_id', 'code', 'image', 'images_large', 'tags', 'related_articles', 'related_products'], 'string', 'max' => 255],
            [['active', 'salse', 'hot', 'best_seller'], 'string', 'max' => 4],
            [['pro_name'], 'unique'],
            [['slug'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pro_name' => 'Pro Name',
            'title' => 'Title',
            'slug' => 'Slug',
            'keyword' => 'Keyword',
            'description' => 'Description',
            'short_introduction' => 'Short Introduction',
            'content' => 'Content',
            'price' => 'Price',
            'price_sales' => 'Price Sales',
            'start_sale' => 'Start Sale',
            'end_sale' => 'End Sale',
            'order' => 'Order',
            'active' => 'Active',
            'product_type_id' => 'Product Type ID',
            'salse' => 'Salse',
            'hot' => 'Hot',
            'best_seller' => 'Best Seller',
            'manufacturer_id' => 'Manufacturer ID',
            'guarantee' => 'Guarantee',
            'models_id' => 'Models ID',
            'views' => 'Views',
            'code' => 'Code',
            'image' => 'Image',
            'images_large' => 'Images Large',
            'tags' => 'Tags',
            'product_category_id' => 'Product Category ID',
            'related_articles' => 'Related Articles',
            'related_products' => 'Related Products',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
        ];
    }

    // Lấy danh sách sản phẩm mới về, phổ biến, best sales , với tham số truyền vào
    public function getProductByType($product_type_id,$status = true)
    // $product_type_id = array();
    {
        $data = self::find()->select(['id','product_type_id'])->where('active=:status',[':status'=>$status])->all();
        $idPro = [];
        foreach ($data as $product) {
            if ($product->product_type_id =='') {
                continue;
            }
            foreach ($product_type_id as $type) {
                if (in_array($type,json_decode($product->product_type_id))) {
                    $idPro[$product->id] = $product->id;
                }
            }
        }
        
        unset($data);
        return $idPro;
    }

    // Laays tất cả các sản phẩm có product_category_id nằm trong mảng $idCate = []
    public function getAllProductByIdCate($idCate,$status = true)
    {
        return self::find()->select(['id','product_category_id','pro_name','slug','image','product_type_id','price_sales','price','short_introduction'])->where('active=:status',[':status'=>$status])->andWhere(['in','product_category_id',$idCate])->all();
    }

    // Lấy id sản phẩm với slug truyền vào
    public function getProductId($slug,$status=true)
    {
        $data = self::find()->select(['id'])->where('slug=:slug AND active=:status',[':slug'=>$slug,':status'=>$status])->one();
        return $data->id;
    }

    // Lấy thông tin sản phẩm liên quan idPro truyền vào
    public function getProductRelated($id,$status = true){
        return self::find()->select(['id','pro_name','slug','image','product_type_id','price_sales','price','short_introduction'])->where('active=:status',[':status'=>$status])->andWhere(['in','id',$id])->all();
    }

    // Lấy danh sách sản phẩm với slug cate truyền vào
    public function getAllProBySlug($slug,$status = true)
    {
        $data = $this->getIdCate($slug);
        $idCate = $data->idCate;
        $idCate = $this->getChildrenIdCate($idCate);
        return $this->getAllProductByIdCate($idCate);
    }

    // trả về Idcate với slug truyền vào
    private function getIdCate($slug)
    {
        return ProductCategory::findOne(['slug'=>$slug,'active'=>true]);
    }

    private function getChildrenIdCate($idCate)
    {
        $data = ProductCategory::find()->select('idCate')->where(['cate_parent_id'=>$idCate,'active'=>true])->all();
        $idList[] = $idCate;
        if (!empty($data)) {
            foreach ($data as $value) {
                $idList[] = $value->idCate;
            }
        }
        return $idList;
    }
}
