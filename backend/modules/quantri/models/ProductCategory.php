<?php

namespace backend\modules\quantri\models;

use Yii;

/**
 * This is the model class for table "tbl_product_category".
 *
 * @property int $idCate
 * @property string $title
 * @property string $cateName
 * @property int $group_id
 * @property int $cate_parent_id
 * @property string $slug
 * @property string $keyword
 * @property string $description
 * @property string $content
 * @property string $short_introduction
 * @property int $home_page
 * @property string $image
 * @property int $order
 * @property int $active
 * @property int $created_at
 * @property int $updated_at
 * @property int $user_id
 */
class ProductCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_product_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'cateName', 'group_id', 'active', 'created_at', 'updated_at', 'user_id'], 'required'],
            [['group_id', 'cate_parent_id', 'order', 'created_at', 'updated_at', 'user_id'], 'integer'],
            [['keyword', 'description', 'content', 'short_introduction'], 'string'],
            [['title', 'cateName', 'slug', 'image'], 'string', 'max' => 255],
            [['home_page', 'active'], 'string', 'max' => 4],
            [['cateName'], 'unique'],
            [['slug'], 'unique','message'=>'{attribute} này đã có xin chọn đường dẫn khác'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idCate' => 'Id Cate',
            'title' => 'Tiêu đề',
            'cateName' => 'Tên danh mục',
            'group_id' => 'Nhóm',
            'cate_parent_id' => 'Danh mục cha',
            'slug' => 'Slug',
            'keyword' => 'Keyword',
            'description' => 'Description',
            'content' => 'Chi tiết',
            'short_introduction' => 'Mô tả ngắn',
            'home_page' => 'Hiện ở trang chủ',
            'image' => 'Ảnh',
            'order' => 'Sắp xếp',
            'active' => 'Kích hoạt',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
        ];
    }

    private $data;
    public function getCategoryParent($parent = 0,$level = '')
    {
        $result = Productcategory::find()->asArray()->where('active =:active AND cate_parent_id =:parent',['active'=>1,'parent'=>$parent])->all();
        $level .='--| ';
        foreach ($result as $key=>$value) {
            if($parent == 0){
                $level='';
            }
            $this->data[$value['idCate']] = $level.$value['cateName'];
            self::getCategoryParent($value['idCate'],$level);
        }

        return $this->data;
    }

    // Lấy tên sp cho ra view
    public function getCateName($id,$status=true)
    {
        $data =  ProductCate::find()->select('cateName')->where('active =:Status AND idCate=:id',['Status'=>$status,'id'=>$id])->one();
        return $data->cateName;
    }
}
