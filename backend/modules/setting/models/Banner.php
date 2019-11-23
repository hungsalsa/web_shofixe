<?php

namespace backend\modules\setting\models;

use Yii;

/**
 * This is the model class for table "tbl_banner".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $content
 * @property string $content_mobile
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $user_add
 * @property int $user_edit
 */
class Banner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_banner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'created_at', 'updated_at', 'user_add'], 'required'],
            [['content', 'content_mobile'], 'string'],
            [['created_at', 'updated_at', 'user_add', 'user_edit'], 'integer'],
            [['title'], 'string', 'max' => 60],
            [['description', 'keywords'], 'string', 'max' => 150],
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
            'title' => 'Seo Title',
            'description' => 'Seo Description',
            'keywords' => 'Keywords',
            'content' => ' Banner Desktop',
            'content_mobile' => 'Banner Mobile',
            'status' => 'Kích hoạt',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_add' => 'User Add',
            'user_edit' => 'User Edit',
        ];
    }
}
