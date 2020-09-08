<?php

namespace backend\modules\sanpham\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ChingaySearch represents the model behind the search form of `backend\modules\chi\models\Chingay`.
 */
class NhanbanSearch extends Model
{
    /**
     * @inheritdoc
     */
    public $cuahang;
    public $danhmuc;

    public function rules()
    {
        return [
            [['cuahang', 'danhmuc'], 'safe'],
            [['cuahang', 'danhmuc'], 'required','message'=>' {attribute} không được để trống']
        ];
    }
    public function attributeLabels()
    {
        return [
            'cuahang' => 'Chọn cửa hàng',
            'danhmuc' => 'Danh mục sản phẩm',
        ];
    }

}
