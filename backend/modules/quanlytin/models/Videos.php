<?php

namespace backend\modules\quanlytin\models;

use Yii;
use backend\models\User;

/**
 * This is the model class for table "tbl_videos".
 *
 * @property int $idVideo
 * @property string $name
 * @property string $slug
 * @property string $seo_title
 * @property string $seo_description
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $user_add
 * @property int $user_edit
 */
class Videos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_videos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'slug', 'status', 'created_at', 'user_add','category_id','link'], 'required'],
            [['created_at', 'updated_at', 'user_add', 'user_edit','category_id','showtab'], 'integer'],
            [['name', 'slug', 'seo_description','link'], 'string', 'max' => 255],
            [['seo_title'], 'string', 'max' => 150],
            // [['status'], 'string', 'max' => 4],
            [['content'], 'string'],
            [['sort'], 'isNumeric'],
            [['slug'], 'unique'],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idVideo' => 'Id Video',
            'name' => 'Tên Video',
            'category_id' => 'Danh mục',
            'slug' => 'Đường dẫn',
            'showtab' => 'Hiện TabVideo',
            'link' => 'Link liên kết',
            'sort' => 'Sắp xếp',
            'seo_title' => 'Seo Title',
            'seo_description' => 'Seo Description',
            'content' => 'Chi tiết',
            'status' => 'Kích hoạt',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày sửa',
            'user_add' => 'Người thêm',
            'user_edit' => 'Người sửa',
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

    public function getUserAdd()
    {
        return $this->hasOne(User::className(),['id'=>'user_add']);
    }
    public function getUserEdit()
    {
        return $this->hasOne(User::className(),['id'=>'user_edit']);
    }
}
