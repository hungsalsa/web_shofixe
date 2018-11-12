<?php

namespace backend\modules\setting\models;

use Yii;

/**
 * This is the model class for table "tbl_menus".
 *
 * @property int $id
 * @property string $name
 * @property int $type Kiểu của menu: sản phẩm, hay tin tức
 * @property string $introduction
 * @property int $parent_id
 * @property int $link_cate Liên kết đến dm sp, hay dm bài viết
 * @property int $order
 * @property string $image
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $user_id
 */
class Menus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_menus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'slug', 'type', 'status', 'created_at', 'updated_at', 'user_id'], 'required'],
            [['type', 'parent_id', 'link_cate', 'order', 'created_at', 'updated_at', 'user_id'], 'integer'],
            [['introduction'], 'string'],
            [['name', 'title', 'slug', 'image'], 'string', 'max' => 255],
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
            'name' => 'Name',
             'title' => 'Title',
            'slug' => 'Slug',
            'type' => 'Type',
            'introduction' => 'Introduction',
            'parent_id' => 'Parent ID',
            'link_cate' => 'Link Cate',
            'order' => 'Order',
            'image' => 'Image',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
        ];
    }

    public $data;
    public function getMenuParent($parent = 0,$level = '')
    {
        $result = Menus::find()->asArray()->where('status =:Active AND parent_id =:parent',['Active'=>1,'parent'=>$parent])->all();
        $level .='--| ';
        foreach ($result as $key=>$value) {
            if($parent == 0){
                $level='';
            }
            $this->data[$value['id']] = $level.$value['name'];
            self::getMenuParent($value['id'],$level);
        }
        return $this->data;
    }
}
