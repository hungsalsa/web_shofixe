<?php

namespace app\modules\setting\models;


use frontend\modules\quantri\models\Categories;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_menus".
 *
 * @property int $id
 * @property string $name
 * @property string $title
 * @property string $slug
 * @property int $type Kiểu của menu: sản phẩm, hay tin tức
 * @property string $introduction
 * @property int $parent_id
 * @property int $link_cate Liên kết đến dm sp, hay dm bài viết
 * @property int $order
 * @property string $image
 * @property int $mega
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $user_id
 */
class FMenus extends \yii\db\ActiveRecord
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
            [['name', 'mega', 'status', 'created_at', 'updated_at', 'user_id'], 'required'],
            [['type', 'parent_id', 'link_cate', 'order', 'created_at', 'updated_at', 'user_id'], 'integer'],
            [['introduction'], 'string'],
            [['name', 'title', 'slug', 'image'], 'string', 'max' => 255],
            // [['mega', 'status'], 'string', 'max' => 4],
            [['name'], 'unique'],
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
            'mega' => 'Mega',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
        ];
    }

    public function getParent() {
        return $this->hasMany(FMenus::className(), ['parent_id' => 'id']);
    }

    public function getCategory() {
        return $this->hasOne(Categories::className(), ['id' => 'link_cate']);
    }
    public function getPage() {
        return $this->hasOne(Pages::className(), ['id' => 'link_cate']);
    }

    public function MenuHome($parent = 0)
    {

        return self::find()->select(['id','name','slug','title','link_cate'])
        ->where('status=:status AND parent_id=:parent',[':status'=>true,':parent'=>$parent])->orderBy(['order'=>SORT_ASC,'updated_at'=>SORT_DESC])->asArray()->all();
    }

    public function getAllMenu($parent = 0)
    {
        return self::find()->alias('mn')
        // ->select(['{{mn}}.*','{{pr}}.*','cate.slug'])
        // ->select(['{{mn}}.*','{{parent}}.*','cate.slug'])
        // ->joinWith(['parent pr'])
        // ->joinWith(['category cate'=>function($query){
        //     $query->select(['cate.slug','id as macate']);
        // }])
        ->where('mn.status=:status AND mn.parent_id=:parent',[':status'=>true,':parent'=>$parent])->orderBy(['order'=>SORT_ASC])->all();
        // ->where('mn.status=:status AND mn.parent_id=:parent',[':status'=>true,':parent'=>$parent])->asArray()->all();
    }
}
// $data = Chitietchi::find()->alias('ct')->select(['{{ct}}.*', '([[quantity]] * [[money]]) AS dongia','name', ])->asArray()->all();