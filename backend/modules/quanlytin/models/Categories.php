<?php

namespace backend\modules\quanlytin\models;

use Yii;
use backend\models\User;
/**
 * This is the model class for table "tbl_categories".
 *
 * @property int $id
 * @property string $cateName
 * @property int $groupId
 * @property int $parent_id
 * @property string $link
 * @property string $images
 * @property int $sort
 * @property string $seo_title
 * @property string $keyword
 * @property string $seo_descriptions
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $userAdd
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cateName','seo_title', 'status','slug'], 'required'],
            [['groupId', 'parent_id', 'created_at', 'updated_at', 'userAdd','user_edit'], 'integer'],
            [['seo_descriptions', 'content'], 'string'],
            [['cateName', 'images', 'seo_title', 'keyword'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 4],
            [['sort'], 'isNumeric'],
            [['cateName'], 'unique'],
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
            'cateName' => 'Tên danh mục',
            'groupId' => 'Nhóm',
            'parent_id' => 'Danh mục cha',
            'content' => 'Nội dung',
            'images' => 'Ảnh đại diện',
            'sort' => 'Sắp xếp',
            'slug' => 'Đường dẫn',
            'seo_title' => 'Seo Title',
            'keyword' => 'Seo Keywords',
            'seo_descriptions' => 'Seo Description',
            'status' => 'Kích hoạt',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày sửa',
            'userAdd' => 'Người thêm',
            'user_edit' => 'Người sửa',
        ];
    }
    public function isNumeric($attribute, $params)
    {
        if (!is_numeric($this->sort))
            $this->addError($attribute, Yii::t('app', '{attribute} must be numeric', ['{attribute}'=>$attribute]));
    }
    private $data;
    public function getCategoryParent($parent = 0,$level = '')
    {
        $result = self::find()->asArray()->where('status =:active AND parent_id =:parent',['active'=>true,'parent'=>$parent])->all();

        $level .='--| ';
        foreach ($result as $key=>$value) {
            if($parent == 0){
                $level='--| ';
            }
            $this->data[$value['id']] = $level.$value['cateName'];
            self::getCategoryParent($value['id'],$level);
        }

        return $this->data;
    }

    public function getParent()
    {
        return $this->hasOne(Categories::className(),['id'=>'parent_id']);
    }
    public function getTrangthai()
    {
        return $this->hasOne(Status::className(),['ids'=>'status']);
    }

    public function getTintuc()
    {
        return $this->hasOne(News::className(),['category_id'=>'id']);
    }
    public function getUsered()
    {
        return $this->hasOne(User::className(),['id'=>'user_edit']);
    }
    public function getUserad()
    {
        return $this->hasOne(User::className(),['id'=>'userAdd']);
    }

    
}
