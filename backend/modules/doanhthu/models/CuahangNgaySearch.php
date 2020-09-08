<?php

namespace backend\modules\doanhthu\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\doanhthu\models\CuahangNgay;

/**
 * CuahangNgaySearch represents the model behind the search form of `backend\modules\doanhthu\models\CuahangNgay`.
 */
class CuahangNgaySearch extends CuahangNgay
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cuahang_id'], 'integer'],
            [['ngay'], 'safe'],
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
    public function search($params)
    {
        $query = CuahangNgay::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'ngay' => $this->ngay,
            'cuahang_id' => $this->cuahang_id,
        ]);

        return $dataProvider;
    }
}
