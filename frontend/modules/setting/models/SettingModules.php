<?php

namespace app\modules\setting\models;

use Yii;
use yii\helpers\ArrayHelper;
use frontend\modules\quantri\models\Categories;
use app\modules\quantri\models\FNews;

/**
 * This is the model class for table "setting_modules".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $cate_id
 * @property string $page_show
 * @property double $sort
 * @property string $positions
 * @property string $content
 * @property int $status
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
            [['name', 'cate_id', 'page_show', 'status'], 'required'],
            [['cate_id', 'created_at', 'updated_at', 'user_add', 'user_edit'], 'integer'],
            [['sort'], 'number'],
            [['content'], 'string'],
            [['name'], 'string', 'max' => 100],
            [['slug', 'page_show'], 'string', 'max' => 255],
            [['positions'], 'string', 'max' => 150],
            [['status'], 'string', 'max' => 4],
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
            'name' => 'Name',
            'slug' => 'Slug',
            'cate_id' => 'Cate ID',
            'page_show' => 'Page Show',
            'sort' => 'Sort',
            'positions' => 'Positions',
            'content' => 'Content',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_add' => 'User Add',
            'user_edit' => 'User Edit',
        ];
    }

    public function getVitri()
    {
        return $this->hasMany(ModulesPosition::className(),['module_id'=>'id']);
    }

    public function getCategory()
    {
        return $this->hasOne(Categories::className(),['id'=>'cate_id']);//->onCondition(['status' => true]);
    }

    // Laays danh sach cac module va tin tuc tra , ra ngoai trang chu
    public function getAllCategoryHome($positions = [0], $status = true)
    {
        $data =  self::find()->alias('st')
        ->innerJoinWith('vitri p',true)
        ->innerJoinWith('category ca',false)
        ->andWhere(['st.status'=>$status,'p.status'=>$status])
        ->andWhere(['IN','p.position',$positions])
        ->orderBy(['sort' => SORT_ASC, 'created_at' => SORT_DESC])
        ->all();
        $result = [];
        $cate = new Categories();
        $new = new FNews();
// pr($data);
        foreach ($data as $value) {
            $category = $value->category;
            $idCateArray = $cate->getAllChildByID($category->id);
            // dbg($new->getAllnewsByCateID($idCateArray));
            // dbg($idCateArray);
            $result[] = [
                'moduleName' => $value->name,
                'positions' => $value->positions,
                'slug' => $category->slug,
                'seo_title' => $category->seo_title,
                // 'idCate' => $cate->getAllChildByID($category->id),
                'news'=>$new->getAllnewsByCateID($idCateArray,6)
            ];

        }
        return $result;
    }
}
