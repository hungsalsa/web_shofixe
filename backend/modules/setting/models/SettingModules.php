<?php

namespace backend\modules\setting\models;

use Yii;
use backend\modules\quanlytin\models\Categories;
/**
 * This is the model class for table "setting_modules".
 *
 * @property int $id
 * @property int $name
 * @property string $slug
 * @property int $cate_id
 * @property string $page_show
 * @property double $sort
 * @property int $positions
 * @property string $content
 * @property int $created_at
 * @property int $updated_at
 * @property int $user_add
 * @property int $user_edit
 */
class SettingModules extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'setting_modules';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'cate_id','status'], 'required'],
            [['cate_id', 'created_at', 'updated_at', 'user_add', 'user_edit'], 'integer'],
            [[ 'page_show','positions'], 'safe'],
            [['sort'], 'number'],
            [['content'], 'string'],
            [['slug','name'], 'string', 'max' => 255],
            // [['positions'], 'string', 'max' => 4],
            [['cate_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên hiển thị',
            'slug' => 'Đường dẫn',
            'cate_id' => 'Thuộc danh mục',
            'page_show' => 'Trang hiển thị',
            'sort' => 'Sắp xếp',
            'positions' => 'Vị trí hiển thị',
            'content' => 'Nội dung',
            'status' => 'Kích hoạt',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày sửa',
            'user_add' => 'Người tạo',
            'user_edit' => 'Người sửa',
        ];
    }

    public function getDanhmuc()
    {
        return $this->hasOne(Categories::className(),['id'=>'cate_id']);
    }
}
