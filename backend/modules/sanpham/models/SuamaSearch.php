<?php

namespace backend\modules\sanpham\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ChingaySearch represents the model behind the search form of `backend\modules\chi\models\Chingay`.
 */
class SuamaSearch extends Model
{
    /**
     * @inheritdoc
     */
    public $matim;
    public $masua;

    public function rules()
    {
        return [
            [['matim', 'masua'], 'safe'],
            [['matim'], 'required','message'=>' {attribute} không được để trống']
        ];
    }
    public function attributeLabels()
    {
        return [
            'matim' => 'Mã tìm kiếm',
            'masua' => 'Mã thay thế',
        ];
    }

}
