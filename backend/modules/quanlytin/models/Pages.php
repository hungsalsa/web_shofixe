<?php

namespace backend\modules\quanlytin\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_pages".
 *
 * @property int $id
 * @property string $name
 * @property string $title
 * @property string $slug
 * @property string $short_introduction
 * @property int $status
 * @property string $keywords
 * @property string $description
 * @property string $content
 * @property string $tag_product
 * @property string $tag_news
 * @property int $created_at
 * @property int $updated_at
 * @property int $user_id
 */
class Pages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'status', 'content','slug'], 'required'],
            [['short_introduction', 'description', 'content'], 'string'],
            [['created_at', 'updated_at', 'user_id'], 'integer'],
            [['name', 'title', 'slug', 'keywords'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 4],
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
            'name' => 'Tên trang',
            'title' => 'Tiêu đề trang web',
            'slug' => 'Đường dẫn',
            'short_introduction' => 'Giới thiệu ngắn',
            'status' => 'Kích hoạt',
            'keywords' => 'Keywords',
            'description' => 'Description',
            'content' => 'Nội dung',
            'tag_product' => 'Sản phẩm liên quan',
            'tag_news' => 'Bài viết liên quan',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
        ];
    }

    public function getPageAll()
    {
        return ArrayHelper::map(Pages::find()->asArray()->where('status =:Status',['Status'=>1])->orderBy(['name' => SORT_ASC, ])->all(),'id','name');
    }
}
