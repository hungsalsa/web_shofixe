<?php
namespace common\models;
use yii\base\Model;
use yii\db\ActiveRecord;
class Search extends ActiveRecord
{
	public static function tableName()
	{
		return 'Slug';
	}
	public function rules()
	{
		return [
			[['title','slug'],'string','required'],
			
		];
	}
	public function attributesLabels()
	{
		return [
				'title'=>'Tiêu đề',
				'slug' => 'Url đẹp',
		];
	}
}