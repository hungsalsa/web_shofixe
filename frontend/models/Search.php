<?php
namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;
class Search extends ActiveRecord
{
    // public static function tableName()
    // {
    //     return 'Slug';
    // }
    public $keySearch;
    public function rules()
    {
        return [
            [['keySearch'],'safe'],
            
        ];
    }
    public function attributesLabels()
    {
        return [
                'keySearch' => 'Url đẹp',
        ];
    }
}