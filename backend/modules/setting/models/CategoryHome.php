<?php

namespace backend\modules\setting\models;

use Yii;
use backend\modules\quanlytin\models\Categories;
/**
 * This is the model class for table "tbl_setting_category_home".
 *
 * @property int $id
 * @property string $name
 * @property int $link_cate
 * @property string $slug
 * @property string $title
 * @property string $description
 * @property int $order
 * @property string $icon
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $user_add
 */
class CategoryHome extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_setting_category_home';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'link_cate', 'status', 'created_at', 'updated_at', 'user_add'], 'required'],
            [['link_cate', 'order', 'created_at', 'updated_at', 'user_add'], 'integer'],
            [['description'], 'string'],
            [['name', 'slug', 'title', 'icon'], 'string', 'max' => 255],
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
            'link_cate' => 'Link Cate',
            'slug' => 'Slug',
            'title' => 'Title',
            'description' => 'Description',
            'order' => 'Order',
            'icon' => 'Icon',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_add' => 'User Add',
        ];
    }

    public function getDanhmuc()
    {
        return $this->hasOne(Categories::className(),['id'=>'link_cate']);
    }
}
