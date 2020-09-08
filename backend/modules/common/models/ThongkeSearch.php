<?php

namespace backend\modules\common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ChingaySearch represents the model behind the search form of `backend\modules\chi\models\Chingay`.
 */
class ThongkeSearch extends Model
{
    /**
     * @inheritdoc
     */
    public $cate_id;
    public $bike_id;
    public $cuahang_id;
    public $proId;

    public function rules()
    {
        return [
            // [['id', 'total_money', 'created_at', 'updated_at', 'user_add'], 'integer'],
            [['cate_id', 'bike_id','cuahang_id','proId'], 'safe'],
            // [['start_date','end_date'], 'validatedate'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'bike_id' => 'Xe sử dụng',
            'cate_id' => 'Danh mục sản phẩm',
            'cuahang_id' => 'Cửa hàng',
            'proId' => 'Sản phẩm',
        ];
    }


    // public function validatedate($attribute, $params)
    // {

    //     $start_date = $this->$start_date;
    //     $end_date = $this->$end_date;
    //     // print_r($params);die;
    //     if ($start_date != '' && $end_date ='') {
    //         $this->addError($attribute, 'Chọn ngày kết thúc');
    //     }
        
    // }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    
}
