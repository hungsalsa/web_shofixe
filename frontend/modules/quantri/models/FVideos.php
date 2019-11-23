<?php

namespace app\modules\quantri\models;

use Yii;
use frontend\modules\quantri\models\Categories;
use yii\data\Pagination;
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
class FVideos extends \yii\db\ActiveRecord
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
            [['name', 'slug', 'status', 'created_at', 'user_add','link','category_id'], 'required'],
            [['created_at', 'updated_at', 'user_add', 'user_edit','showtab','category_id'], 'integer'],
            [['name', 'slug', 'seo_description'], 'string', 'max' => 255],
            [['seo_title'], 'string', 'max' => 150],
            [['status'], 'string', 'max' => 4],
            [['content'], 'string'],
            [['sort'], 'number'],
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
            'name' => 'Name',
            'slug' => 'Slug',
            'sort' => 'sort',
            'link' => 'link',
            'category_id' => 'category_id',
            'seo_title' => 'Seo Title',
            'seo_description' => 'Seo Description',
            'status' => 'Status',
            'showtab' => 'showtab',
            'content' => 'content',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_add' => 'User Add',
            'user_edit' => 'User Edit',
        ];
    }
    private function getId($slug)
    {
        $data = self::find()->select('idVideo')->where(['slug' => $slug, 'status' => true])->one();
        return $data->idVideo;
    }
    public function getOnevideo($slug)
    {
        // $id = $this->getId($slug);
        $data = self::find()->alias('v')
        ->select(['v.idVideo id','v.name as vname','ca.cateName','ca.slug cate_slug','v.slug as vslug','v.link as vlink','v.seo_title as vtitle','v.seo_description as vseo_description','{{c}}.*'])
        ->joinWith('videocate c',true)
        ->joinWith('category ca',false)
        
        // ->joinWith(['videocate c' => function (ActiveQuery $query) {
        //     return $query
        //     ->select(['name','slug','link','seo_title','seo_description'])->all();
        //     // ->andWhere(['=', 'meta_data.published_state', 1]);
        // }])
        ->where(['v.slug' => $slug, 'v.status' => true])->asArray()->one();
        return $data;
        // dbg($data);
    }

    public function getVideocate()
    {
        return $this->hasMany(FVideos::className(),['idVideo'=>'category_id'])->orderBy(['created_at'=>SORT_DESC,'name'=>SORT_ASC]);
    }
    public function getCategory()
    {
        return $this->hasOne(Categories::className(),['id'=>'category_id'])->orderBy(['created_at'=>SORT_DESC,'name'=>SORT_ASC]);
    }

    public function getVideos($limit,$status=true)
    {
        $data = self::find()->select(['name','slug','seo_title','link'])->where(['status'=>$status,'showtab'=>true])->orderBy(['sort' => SORT_ASC,'created_at' => SORT_DESC]);
        if ($limit != '') {
            $data->limit($limit);
        }
        return $data->asArray()->all();
    }

    public function getVideoByCate($slug)
    {
        $category = new Categories();
        $idcate = $category->getId($slug);
        $pages = $this->dataPagerVideo($idcate);

        $data = self::find()->alias('v')->select(['name','category_id','v.slug','ca.slug cate_slug','v.seo_title','link','v.content','v.created_at','ca.cateName','ca.seo_title CateTitle'])
        ->innerJoinWith('category ca',false)
        ->where(['v.status'=>true,'ca.slug'=>$slug]);
        $data = $data->orderBy(['v.sort' => SORT_ASC,'v.created_at' => SORT_DESC])->offset($pages->offset)
                ->limit($pages->limit)
                ->asArray()
                ->all();
        $category = reset($data);
                // dbg($category);
        $category = ['CateTitle'=>$category['CateTitle'],'cateName'=>$category['cateName']];
        return [
            'pages'=>$pages,
            'category'=>$category,
            'video'=>$data,
        ];
    }

    private function getIdCate($slug)
    {
        $data = self::find()->select(['ca.id idcate'])->innerJoinWith('category ca',false)->where('ca.slug=:active',[':active'=>$slug])->one();
        return $data->idcate;
    }

    private function dataPagerVideo($idcate='',$status = true)
    {
        $data =  self::find()
        ->select(['id'])
        ->where('status=:active',[':active'=>$status]);
        if ($idcate !='') {
            $data->andWhere(['category_id'=>$idcate]);
        }

        $pagination  = new Pagination([
            'totalCount' => $data->count(), 'pageSize'=>10,
             'pageSizeParam' => false, 'forcePageParam' => false,
             // 'route'=>false,
        ]);
        return $pagination;
    }

    public function getAllVideo($status = true)
    {

        $pages = $this->dataPagerVideo();

        $data = self::find()->alias('v')->select(['name','category_id','v.slug','ca.slug cate_slug','v.seo_title','link','v.content','v.created_at','ca.cateName'])
        ->innerJoinWith('category ca',false)
        ->where(['v.status'=>$status]);

        return [
            'pages'=>$pages,
            'data'=>$data->orderBy(['v.sort' => SORT_ASC,'v.created_at' => SORT_DESC])->offset($pages->offset)
                ->limit($pages->limit)
                ->asArray()
                ->all(),
        ];
        
    }
}
