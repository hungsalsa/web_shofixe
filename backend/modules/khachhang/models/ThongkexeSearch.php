<?php

namespace backend\modules\khachhang\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ChingaySearch represents the model behind the search form of `backend\modules\chi\models\Chingay`.
 */
class ThongkexeSearch extends Model
{
    /**
     * @inheritdoc
     */
    public $khachhang;
    public $xe_kh;
    // public $end_date;
    // public $cuahang_id;

    public function rules()
    {
        return [
            [['khachhang'], 'required','message'=>'Phải nhập {attribute} cần tra cứu'],
            [['khachhang','xe_kh'], 'safe'],
            // [['start_date','end_date'], 'validatedate'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'khachhang' => 'Thông tin khách hàng',
            'xe_kh' => 'Xe khách hàng',
        ];
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
