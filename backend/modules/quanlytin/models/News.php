<?php

namespace backend\modules\quanlytin\models;

use Yii;
use yii\helpers\ArrayHelper;
use backend\models\User;
/**
 * This is the model class for table "tbl_news".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $images
 * @property string $image_category
 * @property string $image_detail
 * @property int $category_id
 * @property string $seo_title
 * @property string $seo_keyword
 * @property string $seo_descriptions
 * @property string $short_description
 * @property string $content
 * @property int $hot
 * @property int $view
 * @property string $related_products
 * @property string $related_news
 * @property int $sort
 * @property int $status
 * @property int $user_add
 * @property int $created_at
 * @property int $updated_at
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'slug', 'category_id', 'content', 'status','seo_title','seo_descriptions'], 'required'],
            [['category_id', 'view',  'user_add', 'created_at', 'updated_at', 'see_more','status'], 'integer'],
            [['hot'], 'safe'],
            // [['category_id', 'view', 'sort', 'user_add', 'created_at', 'updated_at'], 'integer'],
            [['seo_descriptions', 'short_description', 'content'], 'string'],
            [['name', 'slug', 'image_category', 'image_detail', 'seo_title', 'seo_keyword'], 'string', 'max' => 255],
            // [['name', 'slug', 'images', 'image_category', 'image_detail', 'seo_title', 'seo_keyword'], 'string', 'max' => 255],
            // [['hot'], 'string', 'max' => 11],
            [['sort'], 'isNumeric'],
            [['slug'], 'unique'],
            [['name'], 'unique'],
        ];
    }

    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tiêu đề tin',
            'images' => 'Ảnh',
            'image_category' => 'Image Category',
            'image_detail' => 'Image Detail',
            'category_id' => 'Danh mục tin',
            'seo_title' => 'Seo Title',
            'slug' => 'Đường dẫn',
            'seo_keyword' => 'Seo Keywords',
            'seo_descriptions' => 'Seo description',
            'short_description' => 'Mô tả ngắn',
            'content' => 'Nội dung',
            'hot' => 'Nổi bật',
            'view' => 'Lượt xem',
            'see_more' => 'Xem nhiều',
            'popular' => 'Phổ biến',
            'related_products' => 'Related Products',
            'related_news' => 'Tin liên quan',
            'sort' => 'Sắp xếp',
            'status' => 'Kích hoạt',
            'user_add' => 'Người thêm',
            'user_edit' => 'Người sửa',
            'created_at' => 'Ngày thêm',
            'updated_at' => 'Ngày sửa',
        ];
    }
    public function isNumeric($attribute, $params)
    {
        if (!is_numeric($this->sort))
            $this->addError($attribute, Yii::t('app', '{attribute} must be numeric', ['{attribute}'=>$attribute]));
    }
    public function getDanhmuc()
    {
        return $this->hasOne(Categories::className(),['id'=>'category_id']);
    }

    // cho sang sản phẩm mới, tin liên quan
    public function getAllNews($status = true)
    {
        return ArrayHelper::map(self::find()->where('status=:active',[':active'=>$status])->all(),'id','name');
    }
    public function getUsered()
    {
        return $this->hasOne(User::className(),['id'=>'user_edit']);
    }
    public function getUserad()
    {
        return $this->hasOne(User::className(),['id'=>'user_add']);
    }
}
