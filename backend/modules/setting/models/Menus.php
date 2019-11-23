<?php

namespace backend\modules\setting\models;

use Yii;
use backend\modules\quanlytin\models\Categories;
use backend\models\User;

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
            /*[['name', 'status', 'created_at', 'updated_at', 'user_id','link_cate'], 'required'],
            [['type', 'parent_id', 'link_cate', 'order', 'created_at', 'updated_at', 'user_id'], 'integer'],
            [['introduction'], 'string'],
            [['name', 'title', 'slug', 'image'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 4],
            [['name'], 'unique'],
            // [['link_cate'], 'unique'],*/
            [['name', 'status', 'created_at', 'updated_at', 'user_id'], 'required'],
            [['type', 'parent_id', 'link_cate', 'created_at', 'updated_at', 'user_id'], 'integer'],
            [['introduction'], 'string'],
            [['name', 'title', 'slug', 'image'], 'string', 'max' => 255],
            // [['mega', 'status'], 'string', 'max' => 4],
            [['name'], 'unique'],
            [['order'], 'isNumeric'],
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
            'title' => 'Title',
            'slug' => 'Đường dẫn',
            'mega' => 'Mega',
            'type' => 'Loại menu',
            'introduction' => 'Introduction',
            'parent_id' => 'Menu cha',
            'link_cate' => 'Liên kết danh mục',
            'order' => 'Sắp xếp',
            'image' => 'Image',
            'status' => 'Kích hoạt',
            'created_at' => 'Created At',
            'updated_at' => 'Ngày sửa',
            'user_id' => 'Người sửa',
        ];
    }

    public function isNumeric($attribute, $params)
    {
        if (!is_numeric($this->order))
            $this->addError($attribute, Yii::t('app', '{attribute} must be numeric', ['{attribute}'=>$attribute]));
    }

    public function getUserad()
    {
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }

    public function getCategory()
    {
        return $this->hasOne(Categories::className(),['id'=>'link_cate']);
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
