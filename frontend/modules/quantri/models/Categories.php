<?php

namespace frontend\modules\quantri\models;

use Yii;

/**
 * This is the model class for table "tbl_categories".
 *
 * @property int $id
 * @property string $cateName
 * @property int $groupId
 * @property int $parent_id
 * @property string $images
 * @property int $sort
 * @property string $title
 * @property string $slug
 * @property string $keyword
 * @property string $descriptions
 * @property string $content
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
            // [['cateName', 'title', 'slug', 'descriptions', 'status', 'created_at', 'updated_at', 'userAdd','showhome'], 'required'],
            // [['groupId', 'parent_id', 'sort', 'created_at', 'updated_at', 'userAdd'], 'integer'],
            // [['descriptions', 'content'], 'string'],
            // [['cateName', 'images', 'title', 'slug', 'keyword'], 'string', 'max' => 255],
            // [['status'], 'string', 'max' => 4],
            // [['cateName'], 'unique'],
            // [['slug'], 'unique'],
            [['cateName','seo_title', 'seo_descriptions', 'status','slug'], 'required'],
            [['groupId', 'parent_id', 'sort', 'created_at', 'updated_at', 'userAdd','user_edit'], 'integer'],
            [['seo_descriptions', 'content'], 'string'],
            [['cateName', 'images', 'seo_title', 'keyword'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 4],
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
            'seo_title' => 'Tiêu đề',
            'keyword' => 'Keywords',
            'seo_descriptions' => 'Descriptions',
            'status' => 'Kích hoạt',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày sửa',
            'userAdd' => 'Người thêm',
            'user_edit' => 'Người sửa',
        ];
    }

    public static function sitemap()
    {
        return self::find()->where('status=1');
    }

    /**
     * @return string
     */
    public function getSitemapUrl()
    {
        return  \yii\helpers\Url::toRoute(['category/index', 'url' => $this->slug], true);
    } 

    public function getParent() {
        return $this->hasMany(Categories::className(), ['parent_id' => 'id']);
    }

    public function getTintuc()
    {
        return $this->hasMany(FNews::className(),['category_id'=>'id'])->orderBy(['created_at'=>SORT_DESC,'name'=>SORT_ASC]);
    }
    public function getTintrangchu()
    {
        return $this->hasMany(FNews::className(),['category_id'=>'id'])->orderBy(['created_at'=>SORT_DESC,'name'=>SORT_ASC])
        ->limit(7);
    }

    private function getCategory($idCate)
    {
        return self::find()->select(['cateName','parent_id','slug'])->where('id =:id AND status =:status', [':id'=>$idCate,':status'=>true])->asArray()->one();
    }

    public function getParentCate($idCate)
    {
        $data = $this->getCategory($idCate);
        $result['main'] = [

            'cateName'=>$data['cateName'],
            'slug'=>$data['slug']
        ];
        if ($data['parent_id']!=0) {
            $data = $this->getCategory($data['parent_id']);
            $result['parent'] = [
                'cateName'=>$data['cateName'],
                'slug'=>$data['slug']
            ];
        } 
        return $result;
    }

    // Hàm lấy tất cả các con và trả về mảng chứa nó, voi slug truyen vao
    function getAllChild($slug)
    {
        if ($id = $this->getId($slug)) {
            $data = self::findAll(['parent_id'=>$id]);
            $idlist = [$id];
            if (!empty($data)) {
                foreach ($data as $value) {
                    $idlist[] = $value->id;
                }
            }
            return $idlist;
        } else {
            return false;
        }
    }
    // Hàm lấy tất cả các con và trả về mảng chứa nó, voi id truyen vao
    public function getAllChildByID($id)
    {
        $data = self::find()->select(['id'])->where(['parent_id'=>$id,'status'=>true])->all();
        $idlist = [$id];
        if (!empty($data)) {
            foreach ($data as $value) {
                $idlist[] = $value->id;
            }
        }
        return $idlist;
    }

    // hamf tra ve id the slug
    public function getId($slug)
    {
        $data = self::findOne(['status'=>true,'slug'=>$slug]);
        if (empty($data)) {
            return false;
        } else {
            return $data->id;
        }
    }

    public function getCategoryAll($idArray)
    {
        
        return self::find()->select(['id','cateName','seo_title','slug','keyword','images','seo_descriptions'])->where(['IN','id',$idArray])->asArray()->all();
        
        // dbg($id);
    }
}
