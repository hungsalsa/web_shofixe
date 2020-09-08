<?php

namespace backend\modules\khachhang\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ChingaySearch represents the model behind the search form of `backend\modules\chi\models\Chingay`.
 */
class InhdSearch extends Model
{
    /**
     * @inheritdoc
     */
    public $khachhang;
    public $ngay_in;
    public $xe_kh;

    public function rules()
    {
        return [
            [['khachhang','ngay_in','xe_kh'], 'required','message'=>'Phải nhập {attribute} cần tra cứu'],
            [['khachhang','ngay_in','xe_kh'], 'safe'],
            // [['start_date','end_date'], 'validatedate'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'khachhang' => 'Thông tin khách hàng',
            'ngay_in' => 'Ngày in thông tin',
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
