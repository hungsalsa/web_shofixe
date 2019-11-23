<?php

namespace backend\modules\quanlytin\models;

use Yii;

/**
 * This is the model class for table "tbl_tags".
 *
 * @property int $idtag
 * @property string $name
 * @property string $slug
 * @property string $title
 * @property string $keyword
 * @property string $description
 * @property int $created_at
 * @property int $user_add
 */
class Tags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'slug', 'title', 'keyword', 'description', 'created_at', 'user_add'], 'required'],
            [['created_at', 'user_add'], 'integer'],
            [['name'], 'string', 'max' => 150],
            [['slug', 'description'], 'string', 'max' => 255],
            [['title'], 'string', 'max' => 100],
            [['keyword'], 'string', 'max' => 90],
            [['name'], 'unique'],
            [['slug'], 'unique'],
            [['title'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idtag' => 'Idtag',
            'name' => 'Name',
            'slug' => 'Slug',
            'title' => 'Title',
            'keyword' => 'Keyword',
            'description' => 'Description',
            'created_at' => 'Created At',
            'user_add' => 'User Add',
        ];
    }
}
