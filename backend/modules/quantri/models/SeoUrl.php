<?php

namespace backend\modules\quantri\models;

use Yii;

/**
 * This is the model class for table "tbl_seo_url".
 *
 * @property int $seo_url_id
 * @property int $language_id
 * @property string $query
 * @property string $slug
 */
class SeoUrl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_seo_url';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language_id'], 'integer'],
            [['query', 'slug'], 'required'],
            [['query', 'slug'], 'string', 'max' => 255],
            // [['slug'], 'unique'],
            // [['slug'], 'unique','message'=>'{attribute} này đã có xin chọn đường dẫn khác'],
            [['slug', 'query'], 'unique', 'targetAttribute' => ['slug', 'query'],'message'=>'{attribute} này đã có xin chọn đường dẫn khác'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'seo_url_id' => 'Seo Url ID',
            'language_id' => 'Language ID',
            'query' => 'Query',
            'slug' => 'Đường dẫn seo',
        ];
    }

    // Hàm tìm kiếm ID seo URL
    public function getId($slug)
    {
        $data = self::find()->select(['seo_url_id'])->where('slug=:slug',[':slug'=>$slug])->one();
        if($data){
            return $data->seo_url_id;
        }else {
            return false;
        }
    }

    // Hàm tìm kiếm ID seo URL
    public function checkslug($slug)
    {
        return  self::find()->where('slug=:slug',[':slug'=>$slug])->count();
    }
}
