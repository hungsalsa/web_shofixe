<?php

namespace backend\modules\khachhang\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ChingaySearch represents the model behind the search form of `backend\modules\chi\models\Chingay`.
 */
class Mdcapnhat extends Model
{
    /**
     * @inheritdoc
     */
    public $capnhat;
    // public $end_date;
    // public $cuahang_id;

    public function rules()
    {
        return [
            // [['khachhang'], 'required','message'=>'Phải nhập {attribute} cần tra cứu'],
            [['capnhat'], 'safe'],
            // [['start_date','end_date'], 'validatedate'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'capnhat' => 'Cập nhật',
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
