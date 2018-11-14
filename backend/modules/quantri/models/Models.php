<?php

namespace backend\modules\quantri\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "tbl_models".
 *
 * @property int $id
 * @property string $name
 * @property int $parent_id
 * @property string $keyword
 * @property string $description
 * @property string $short_introduction
 * @property string $title
 * @property string $slug
 * @property int $active
 * @property int $order
 */
class Models extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_models';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'active'], 'required'],
            [['parent_id', 'order'], 'integer'],
            [['description', 'short_introduction'], 'string'],
            [['name', 'keyword', 'title', 'slug'], 'string', 'max' => 255],
            [['active'], 'string', 'max' => 4],
            [[ 'slug'], 'safe'],
            [['name'], 'unique'],
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
            'parent_id' => 'Parent ID',
            'keyword' => 'Keyword',
            'description' => 'Description',
            'short_introduction' => 'Short Introduction',
            'title' => 'Title',
            'slug' => 'Slug',
            'active' => 'Active',
            'order' => 'Order',
        ];
    }

    // Sử dụng cho thêm sp mới
    public function getAllModels($status = true)
    {
        return ArrayHelper::map(self::find()->where('active=:active',[':active'=>$status])->all(),'id','name');
    }
}
