<?php

namespace frontend\modules\quantri\models;

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
            [['slug'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idCate' => 'Id Cate',
            'title' => 'Title',
            'cateName' => 'Cate Name',
            'group_id' => 'Group ID',
            'cate_parent_id' => 'Cate Parent ID',
            'slug' => 'Slug',
            'keyword' => 'Keyword',
            'description' => 'Description',
            'content' => 'Content',
            'short_introduction' => 'Short Introduction',
            'home_page' => 'Home Page',
            'image' => 'Image',
            'order' => 'Order',
            'active' => 'Active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
        ];
    }

    // Hàm lấy tất cả các con của Category, với idCate truyền vào, trả về mảng id
    public function getAllChild($idCate,$status = true)
    {
        $idList[] = $idCate;
        $data = self::find()->select(['idCate'])->where('active=:status AND cate_parent_id=:parent',[':status'=>$status,':parent'=>$idCate])->all();
        if(!empty($data)){
            foreach ($data as $value) {
                $idList[] = $value->idCate;
            }
        }
        unset($data);
        return $idList;
    }
}
