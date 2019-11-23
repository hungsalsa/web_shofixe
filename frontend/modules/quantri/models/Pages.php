<?php

namespace frontend\modules\quantri\models;

use Yii;

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
            [['name', 'status', 'content', 'created_at', 'updated_at', 'user_id'], 'required'],
            [['short_introduction', 'description', 'content'], 'string'],
            [['created_at', 'updated_at', 'user_id'], 'integer'],
            [['name', 'title', 'slug', 'keywords', 'tag_product', 'tag_news'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'title' => 'Title',
            'slug' => 'Slug',
            'short_introduction' => 'Short Introduction',
            'status' => 'Status',
            'keywords' => 'Keywords',
            'description' => 'Description',
            'content' => 'Content',
            'tag_product' => 'Tag Product',
            'tag_news' => 'Tag News',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
        ];
    }
}
