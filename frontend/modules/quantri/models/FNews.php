<?php

namespace app\modules\quantri\models;

use Yii;
use frontend\modules\quantri\models\Categories;
use yii\data\Pagination;

/**
 * This is the model class for table "tbl_news".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $images
 * @property string $image_category
 * @property string $image_detail
 * @property int $category_id
 * @property string $seo_title
 * @property string $seo_keyword
 * @property string $seo_descriptions
 * @property string $short_description
 * @property string $content
 * @property int $popular
 * @property int $hot
 * @property int $view
 * @property int $see_more
 * @property string $related_products
 * @property string $related_news
 * @property double $sort
 * @property int $status
 * @property int $user_add
 * @property int $user_edit
 * @property int $created_at
 * @property int $updated_at
 */
class FNews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'slug', 'category_id', 'seo_title', 'seo_descriptions', 'content', 'status', 'user_add', 'created_at'], 'required'],
            [['category_id', 'view', 'user_add', 'user_edit', 'created_at', 'popular', 'updated_at'], 'integer'],
            [['seo_descriptions', 'short_description', 'content'], 'string'],
            [['sort'], 'number'],
            [['hot'], 'safe'],
            [['name', 'slug', 'images', 'image_category', 'image_detail', 'seo_title', 'seo_keyword', 'related_products', 'related_news'], 'string', 'max' => 255],
            // [['popular', 'see_more', 'status'], 'string', 'max' => 4],
            // [['hot'], 'string', 'max' => 11],
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
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'images' => 'Images',
            'image_category' => 'Image Category',
            'image_detail' => 'Image Detail',
            'category_id' => 'Category ID',
            'seo_title' => 'Seo Title',
            'seo_keyword' => 'Seo Keyword',
            'seo_descriptions' => 'Seo Descriptions',
            'short_description' => 'Short Description',
            'content' => 'Content',
            'popular' => 'Popular',
            'hot' => 'Hot',
            'view' => 'View',
            'see_more' => 'See More',
            'related_products' => 'Related Products',
            'related_news' => 'Related News',
            'sort' => 'Sort',
            'status' => 'Status',
            'user_add' => 'User Add',
            'user_edit' => 'User Edit',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Categories::className(),['id'=>'category_id']);
    }
    // laays ci tri ra slider
    public function getHotposition()
    {
        return $this->hasOne(HotRelatedNewsPosition::className(),['id_new'=>'id']);
    }

    public function getTinlienquan()
    {
        return $this->hasMany(RelatedNewsInterdependent::className(),['id_main'=>'id']);
    }

    public function getNewAll($idList)
    {
        return self::find()->select(['slug','name','view','images','seo_title'])->where(['IN','id',$idList])->orderBy(['created_at'=>SORT_DESC,'name'=>SORT_ASC])->asArray()->all();
    }

    // Lấy tin hot vị trí slider ra ngoài slider
    public function getNewsHots($positions = [1],$limit = 7, $status=true)
    {
        /*$data = self::find()->alias('nw')
        ->where(['nw.status'=>$status,'vt.status'=>$status])
        ->andWhere(['IN','vt.position',$positions])
        ->innerJoinWith('hotposition vt',true)
        ->orderBy(['sort' => SORT_ASC, 'created_at' => SORT_DESC])
        ->limit($limit)
        ->asArray()
        ->all();
dbg($data);*/
        return $data= self::find()->alias('nw')
        ->select(['id idnew','name','slug','images','seo_title','short_description','hot','{{vt}}.id_new','{{vt}}.position'])
        ->innerJoinWith('hotposition vt',false)
        ->where(['nw.status'=>$status,'vt.status'=>$status])
        ->andWhere(['IN','vt.position',$positions])
        ->orderBy(['sort' => SORT_ASC, 'created_at' => SORT_DESC])
        ->limit($limit)
        ->asArray()->all();
    }
    
    public function MostViewedNews($limit = 5,$status=true)
    {
        return self::find()->select(['name','slug','images','seo_title','short_description'])->where(['status'=>$status,'see_more'=>true])->orderBy([ 'updated_at' => SORT_DESC,'sort' => SORT_DESC, 'created_at' => SORT_DESC])->limit($limit)->asArray()->all();
    }

    // Lấy tất cả các danh sách tin mới nhất
    public function latestNews($limit = 5,$status=true)
    {
        return self::find()->select(['name','slug','images','seo_title','short_description'])->where(['status'=>$status])->orderBy(['created_at' => SORT_DESC])->limit($limit)->asArray()->all();
    }

    // Hàm lấy tất cả tin tức theo IDCATE, sử dụng trong insert Module
    public function getAllnewsByCateID($cateArray,$limit=8,$idnews='')
    {
        $data=  self::find()->select(['name','slug','images','short_description','seo_title','created_at'])->where(['status'=>true])->andWhere(['IN','category_id',$cateArray]);
        if ($idnews != '') {
            $data->andWhere(['NOT IN','id',$idnews]);
        }
        if ($limit != '') {
            $data->limit($limit);
        }
        return $data->orderBy(['sort' => SORT_ASC, 'created_at' => SORT_DESC, 'updated_at' => SORT_DESC])->asArray()->all();
    }

    // Lấy Danh sách tin tức với idCate Truyền vào
    public function getAllNews($idCate,$status = true)
    {
        $pages = $this->dataPagerNews($idCate);
        $data =  self::find()->where('status=:active',[':active'=>$status])->andWhere(['IN','category_id',$idCate]);
        return $data->orderBy(['sort' => SORT_ASC, 'created_at' => SORT_DESC, 'updated_at' => SORT_DESC])->offset($pages->offset)
                ->limit($pages->limit)
                ->asArray()
                ->all();
    }
    // Lấy Danh sách tin tức với idCate Truyền vào, loai bo nhung tin tức hot slider (Nhung tin khong nam trong mang $idNew[])
    public function dataPagerNews($idCate,$status = true)
    {
        $data =  self::find()
        ->select(['id'])
        ->where('status=:active',[':active'=>$status])
        ->andWhere(['IN','category_id',$idCate]);

        $pagination  = new Pagination([
            'totalCount' => $data->count(), 'pageSize'=>10,
             'pageSizeParam' => false, 'forcePageParam' => false,
             // 'route'=>false,
        ]);
        return $pagination;
    }
    public function NewsCateNotHotslider($idCate,$status = true)
    {
        $data =  self::find()
        ->select(['id','name','slug','images','seo_title','short_description','hot'])
        ->where('status=:active',[':active'=>$status])
        ->andWhere(['IN','category_id',$idCate]);
        
        $pages = $this->dataPagerNews($idCate);
        /*$pagination  = new Pagination([
            'totalCount' => $data->count(), 'pageSize'=>10,
             'pageSizeParam' => false, 'forcePageParam' => false
        ]);*/

        return $data->orderBy(['sort' => SORT_ASC, 'created_at' => SORT_DESC, 'updated_at' => SORT_DESC])->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
    }

    // Lấy danh sách các tin tức hot chạy slider thuộc danh mục, khi click vao danh mục tin tức
    public function getNewHottlider($idCate,$limit = 5,$status= true)
    {
        return $data= self::find()->alias('nw')
        ->select(['id','name','slug','images','seo_title','short_description','hot'])
        ->innerJoinWith('hotposition vt',false)
        ->where(['nw.status'=>$status,'vt.status'=>$status])
        ->andWhere(['vt.position'=>1])
        ->andWhere(['IN','nw.category_id',$idCate])
        // ->orderBy(['sort' => SORT_ASC, 'created_at' => SORT_DESC])
        ->orderBy(['sort' => SORT_ASC, 'created_at' => SORT_DESC, 'updated_at' => SORT_DESC])
        ->limit($limit)
        ->asArray()->all();
    }

    // Hamf de lay chi tiet khi click vao chi tiet tin tuc
    public function getNewDetail($slug)
    {
        $data = self::find()->alias('n')
        ->select(['id','view','seo_title','n.status','user_add','created_at','updated_at','seo_descriptions','slug','name','images','category_id','related_news','content'])
        ->joinWith('tinlienquan lq',true)
        ->where(['n.slug'=>$slug])
        // ->asArray()
        ->one();
        // dbg($data);
        return $data;
    }

    // Hamf tim kiem trang chu
    public function SearchNew($key)
    {
        $data = self::find()->alias('n')
        ->select(['name','n.slug nslug','n.images nimage','category_id','n.seo_title nseo_title','n.short_description nshort_description','dm.cateName','dm.slug cateSlug'])
        ->joinWith('category dm',false)
        ->where('n.status=:status',[':status'=>true])
        ->andWhere(['Like','name',$key])
        ->asArray()
        ->all();
        return $data;
    }
}
