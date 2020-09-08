<?php

namespace backend\modules\chi\models;

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
    public $start_date;
    public $end_date;
    public $cuahang_id;

    public function rules()
    {
        return [
            // [['id', 'total_money', 'created_at', 'updated_at', 'user_add'], 'integer'],
            [['start_date', 'end_date','cuahang_id'], 'safe'],
            [['start_date','end_date'], 'validatedate'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'start_date' => 'Ngày đầu',
            'end_date' => 'Ngày cuối',
            'cuahang_id' => 'Cửa hàng',
        ];
    }


    public function validatedate($attribute, $params)
    {

        $start_date = $this->$start_date;
        $end_date = $this->$end_date;
        // print_r($params);die;
        if ($start_date != '' && $end_date ='') {
            $this->addError($attribute, 'Chọn ngày kết thúc');
        }
        
    }

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
